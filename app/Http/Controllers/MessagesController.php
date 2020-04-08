<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessagesController extends Controller
{
    /**
     * メッセージ新規登録
     */
    public function create(Request $request)
    {
        Log::debug('メッセージ：create');

        $request->validate([
            'messages' => 'required',
        ]);

        //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
        $id = $request->id;

        $order = Order::where('orders.id', $request->id);

        $saleUserId = Order::join('products', 'orders.product_id', 'products.id')
            ->where('orders.id', $request->id)
            ->select('products.user_id')
            ->first();

        $buyUserId = $order->value('user_id');

        $message = new Message;
        $message->order_id = $id;
        $message->send_user_id = Auth::user()->id;
        //販売者が自分だったら,recieve_user_idは購入者
        $message->recieve_user_id =
            (Auth::user()->id == $saleUserId->user_id) ? $buyUserId : $saleUserId->user_id;
        $message->msg = $request->messages;
        $message->save();

        //メッセージの最終更新日を更新
        $thisOrder = Order::find($request->id);
        $thisOrder->msg_updated_at = $message->created_at;
        $thisOrder->save();

        // リダイレクトする
        return back()->withInput();
    }
}
