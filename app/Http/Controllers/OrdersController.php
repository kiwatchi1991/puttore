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

            $product = Product::find($id);


            //----------------- コンテンツ登録 →　payjpでの支払い処理　↓↓↓--------------
            // try{

            //     \Payjp\Payjp::setApiKey("sk_test_b2ea23efe6354c79bfa31070");
            //     \Payjp\Customer::create(array(
            //         "description" => "テストユーザー2",
            //         "card" => $request->{'payjp-token'}
            //     ));
            //     \Payjp\Charge::create(array(
            //         "customer" => "",
            //         "amount" => $product->default_price,
            //         "currency" => "jpy",
            //     ));
            // } catch(\Payjp\Error\Card $e){

            // }

            //----------------- コンテンツ登録 →　payjpでの支払い処理　↑↑↑--------------

            $order = new Order;
            $order->user_id = Auth::user()->id; 
            $order->product_id = $id;
            $order->sale_price = Product::find($id)->default_price;
            $order->save();
            
        // リダイレクトする
        // その時にsessionフラッシュにメッセージを入れる
        return redirect('/bords')->with('flash_message', __('Registered.'));
    }
}
