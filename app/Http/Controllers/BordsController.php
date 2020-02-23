<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;


class BordsController extends Controller
{
    /**
     * 一覧表示
     */
    public function index(Request $request)
    {
        Log::debug('連絡掲示板：index');

        //注文台帳情報取得
        $id = Auth::user()->id;
        $bords = Order::where('orders.user_id',$id)
        // ->join('products', 'orders.product_id','products.id') //成功パターン
        // ->select('orders','products.user_id')
        // ->get();
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
    public function show(Request $request)
    {

    }
}
