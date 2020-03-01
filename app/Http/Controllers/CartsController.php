<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\DB;
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

        
        //ここで、data-追加か削除で振り分ける
        
        $my_id = Auth::user()->id;
        $product_id = $request->product_id;
        $type = $request->type;

        if($type == "delete"){
            // カート削除
            Log::debug('<<<<<<<< カート削除処理　>>>>>>>>>>>>>');
            $cart = Cart::where('user_id',$my_id)->where('product_id',$product_id)->delete();
            return redirect('/carts');
        }elseif($type == "add"){
            // カート追加
                Log::debug('<<<<<<<< カート追加処理　>>>>>>>>>>>>>');
                $cart = new Cart;
                $cart->user_id = $my_id;
                $cart->product_id = $product_id;
                $cart->save();
                return redirect('/carts');
        }

        // $cart = Cart::where('user_id',$my_id)->where('product_id',$product_id)->count();
        // Log::debug($cart);
        // if($cart > 0){
        //     Log::debug('<<<<<<<< カート削除処理　>>>>>>>>>>>>>');
        //     $cart = Cart::where('user_id',$my_id)->where('product_id',$product_id)->delete();
        //     return response()->json($cart);
        //     // Log::debug('<<<<<<<< 【失敗】カート追加処理　>>>>>>>>>>>>>');
        //     // return false;
            
        // }else{
        //     Log::debug('<<<<<<<< カート追加処理　>>>>>>>>>>>>>');
        //     $cart = new Cart;
        //     $cart->user_id = $my_id;
        //     $cart->product_id = $product_id;
        //     $cart->save();
        //     return response()->json($cart);
        // }
        
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
        $carts = DB::table('carts')
        ->join('products','product_id','=','products.id')
        ->where('carts.user_id',$my_id)
        ->select('products.id','products.pic1','products.name','products.default_price',)
        ->get();

        Log::debug('$cartの中身↓↓');
        Log::debug($carts);

        // $user = DB::table('users')
        // ->join('products', 'users.id', '=', 'products.user_id')
        // ->select('users.id', 'users.account_name')
        // ->where('products.id',$id)
        // ->get();


        // $id = Auth::user()->id;
        // $carts = Cart::where('orders.user_id',$id)
        // ->join('products', 'orders.product_id','products.id')
        // ->join('users','products.user_id','users.id')
        // ->select('orders.id','users.pic','products.name')
        // ->get();
        

        return view('carts.index',[
            'carts' => $carts,
            ]);
    }
}
