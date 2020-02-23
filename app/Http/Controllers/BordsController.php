<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Bord;
use App\Message;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;


class BordsController extends Controller
{
    /**
     * トークルーム一覧表示
     */
    public function index(Request $request)
    {
        Log::debug('連絡掲示板：index');

        //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
        $id = Auth::user()->id;
        $bords = Order::where('orders.user_id',$id)
        ->join('products', 'orders.product_id','products.id')
        ->join('users','products.user_id','users.id')
        ->select('orders.id','users.pic','products.name')
        ->get();
        
        Log::debug('$bords↓↓');
        Log::debug($bords);

        return view('bords.index',[
            'bords' => $bords,
            ]);
    }

     /**
     * 詳細表示
     */
    public function show(Request $request,$id)
    {
        Log::debug('連絡掲示板：show');
        
        $orders = Order::find($id);
        $ordersId = $orders->id;
        Log::debug($orders);
        
        $messages = Message::where('messages.order_id',$id)->get();
        Log::debug('messages↓↓');
        Log::debug($messages);
        // Log::debug($orders->id);

        return view('bords.show',[
            'orders' => $orders,
            'ordersId' => $ordersId,
            'messages' => $messages,
            ]);
    }


    
}
