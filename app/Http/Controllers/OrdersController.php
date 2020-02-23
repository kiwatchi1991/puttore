<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Log;


class OrdersController extends Controller
{
     /**
     * コンテンツ登録
     */
    public function create(Request $request ,$id)
    {

        Log::debug('注文台帳：create');
        
        
        $request->validate([
            // 'name' => 'required|string|max:255',
  
            ]);
            
            Log::debug('これからDBへデータ挿入');
            Log::debug('リクエスト内容↓↓');
            Log::debug($request);

            $order = new Order;
            $order->user_id = Auth::user()->id; 
            $order->product_id = $id;
            $order->sale_price = Product::find($id)->default_price;
            $order->save();
            
        // リダイレクトする
        // その時にsessionフラッシュにメッセージを入れる
        return redirect('/products/mypage')->with('flash_message', __('Registered.'));
    }
}
