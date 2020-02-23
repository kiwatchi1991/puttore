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
            // 'name' => 'required|string|max:255',
  
        ]);
        
        Log::debug('これからDBへデータ挿入');
        Log::debug('リクエスト内容↓↓');
        Log::debug($request);

        // $messages = $request->input('messages');//post内容のうちmessage属性のもの
        
        // Log::debug('$messages：内容');
        // Log::debug($messages);
        
        // $order = new Order;
        // $order->messages()->createMany($messages);

        //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
        $id = $request->id;
        $saleUserId = Order::find($request->id)
        ->join('products', 'orders.product_id','products.id')
        // ->join('users','products.user_id','users.id')
        ->select('products.user_id')
        ->get();

        Log::debug('$saleUserId');
        Log::debug($saleUserId);

        $message = new Message;
        $message->order_id = $id; 
        $message->sendUser_id = Auth::user()->id;
        $message->recieveUser_id = $saleUserId[0]->user_id;
        $message->msg = $request->messages;
        // $message->sale_price = Product::find($id)->default_price;
        $message->save();
        


        // リダイレクトする
        // その時にsessionフラッシュにメッセージを入れる
        return back()->withInput()->with('flash_message', __('Registered.'));
    }
}
