<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use App\Difficulty;
use App\CategoryProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class mypageController extends Controller
{
    /**
     * 一覧機能
     */

    public function index(Request $request)
    {
        // 下書き保存中の作品数
        $drafts = Auth::user()->products()
            ->where('open_flg', 1)
            ->get();

        //出品作品
        $products = Auth::user()->products()->latest()->get();
        $product_category = Product::all();
        $product_difficulty = Product::all();


        //購入済み作品
        $buy_products = DB::table('orders')
            ->where('orders.user_id', Auth::user()->id)
            ->join('products', 'orders.product_id', '=', 'products.id')
            // ->select('products.user_id')
            ->get();

        Log::debug('$buy_products');
        Log::debug($buy_products);

        return view('mypage.index', [
            'products' => $products,
            'product_categories' => $product_category,
            'product_difficulties' => $product_difficulty,
            'drafts' => $drafts,
            'buy_products' => $buy_products,
        ]);
    }
    public function order(Request $request)
    {
        //売上履歴
        $sale_history = DB::table('orders')
            ->join('products','orders.products_id', '=','products.id')
            ->where('products.user_id', Auth::user()->id)
            ->join('users','orders.user_id','=','users.id')
            ->select('')

        return view('mypage.order', []);
    }
}
