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

        Log::debug('これからDBへデータ挿入');
        Log::debug('リクエスト内容↓↓');
        Log::debug($request);

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

        Log::debug('$order');
        Log::debug($order->get());
        Log::debug('$saleUserId');
        Log::debug($saleUserId);
        Log::debug('$saleUserId->user_id');
        Log::debug($saleUserId->user_id);
        Log::debug('$buyUserId');
        Log::debug($buyUserId);

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
        Log::debug('$thisorder');
        Log::debug($thisOrder);
        Log::debug('$thisorder');
        Log::debug($thisOrder->msg_updated_at);


        // リダイレクトする
        return back()->withInput();
    }
}
