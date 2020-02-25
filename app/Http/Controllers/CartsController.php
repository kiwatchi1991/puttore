<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartsController extends Controller
{
    
    /**
     *  カート登録
     */
    public function ajaxcart(Request $request)
    {
        Log::debug('<<<<<<<< ajaxカート発動！>>>>>>>>>>>>>');
        Log::debug('<<<<<<<< $request 内容 >>>>>>>>>>>>>');
        Log::debug($request);

        $product_id = $request->cart;
        $my_id = Auth::user()->id;

        $cart = Cart::where('user_id',$my_id)->where('product_id',$product_id)->count();
        Log::debug($cart);
        if($cart > 0){
            Log::debug('<<<<<<<< カート削除処理　>>>>>>>>>>>>>');
            $cart = Cart::where('user_id',$my_id)->where('product_id',$product_id)->delete();
            return response()->json($cart);
            // Log::debug('<<<<<<<< 【失敗】カート追加処理　>>>>>>>>>>>>>');
            // return false;
            
        }else{
            Log::debug('<<<<<<<< カート追加処理　>>>>>>>>>>>>>');
            $cart = new Cart;
            $cart->user_id = $my_id;
            $cart->product_id = $product_id;
            $cart->save();
            return response()->json($cart);
        }
        
    }

    /**
     *  一覧表示
     */
    
    public function index(Request $request)
    {
        Log::debug('カート：index');

        //カート情報取得
        $product_id = $request->cart;
        $my_id = Auth::user()->id;
        $cart = Cart::where('user_id',$my_id)->where('product_id',$product_id)->count();

        // $id = Auth::user()->id;
        // $carts = Cart::where('orders.user_id',$id)
        // ->join('products', 'orders.product_id','products.id')
        // ->join('users','products.user_id','users.id')
        // ->select('orders.id','users.pic','products.name')
        // ->get();
        
        // Log::debug('$bords↓↓');
        // Log::debug($carts);

        return view('carts.index',[
            'cart' => $cart,
            ]);
    }
}
