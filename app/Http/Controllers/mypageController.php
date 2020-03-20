<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Order;
use App\Category;
use App\Difficulty;
use App\CategoryProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class mypageController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        return view('mypage.index', compact('user'));
    }

    /**
     * プロダクト一覧機能
     */

    public function products(Request $request)
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

        return view('mypage.product', [
            'products' => $products,
            'product_categories' => $product_category,
            'product_difficulties' => $product_difficulty,
            'drafts' => $drafts,
            'buy_products' => $buy_products,
        ]);
    }

    /**
     * 注文管理機能
     */

    public function order(Request $request)
    {
        //====================今月の売上
        $thisMonth = Order::query()
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::user()->id)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.created_at as created_at', 'sale_price', 'status')
            ->orderBy('created_at', 'desc')
            //今月に絞る
            ->whereYear('orders.created_at', date("Y"))
            ->whereMonth('orders.created_at', date("m"))
            ->get()


            ->groupBy(function ($row) {
                return $row->created_at->format('Y年m');
            })
            ->map(function ($day) {
                return $day->sum('sale_price');
            });

        Log::debug('$thisMonth');
        Log::debug($thisMonth);


        //====================未振込依頼売上履歴

        $untransferred = Order::query()
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::user()->id)
            ->where('status', 0)
            ->where('orders.created_at', '<', Carbon::now()->startOfMonth())
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.created_at as created_at', 'sale_price', 'status')
            ->orderBy('created_at', 'desc')
            ->get();


        $untransferred_price = $untransferred->groupBy(function ($row) {
            return $row->status;
        })
            ->map(function ($day) {
                return $day->sum('sale_price');
            });

        Log::debug('$untransferred');
        Log::debug($untransferred);
        Log::debug('$untransferred_price');
        Log::debug($untransferred_price);


        //====================振込依頼済みの売上履歴
        $sale_histories = Order::query()
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->whereIn('status', [1, 2])
            ->where('products.user_id', Auth::user()->id)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.created_at as created_at', 'sale_price', 'status')
            ->orderBy('created_at', 'desc')
            ->get();
        $sales = $sale_histories->groupBy(function ($row) {
            return $row->created_at->format('Y年m');
        })
            ->map(function ($day) {
                return $day->sum('sale_price');
            });


        return view('mypage.order', [
            'sales' => $sales,
            'thisMonth' => $thisMonth,
            'untransferred' => $untransferred,
            'untransferred_price' => $untransferred_price,
        ]);
    }

    //1ヶ月の売上リスト
    public function orderMonth(Request $request, $year_month)
    {
        Log::debug('$year_month');
        Log::debug($year_month);
        $targetYear = substr($year_month, 0, 4);
        $targetMonth = substr($year_month, 7, 2);
        Log::debug('$tergetYear');
        Log::debug($targetYear);
        Log::debug('$targetMonth');
        Log::debug($targetMonth);


        //売上履歴（振込依頼済）
        $sales = Order::query()
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::user()->id)
            ->whereYear('orders.created_at', $targetYear)
            ->whereMonth('orders.created_at', $targetMonth)

            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.created_at as created_at', 'sale_price', 'status', 'products.name')
            ->orderBy('created_at', 'desc')
            ->get();

        Log::debug('$sales');
        Log::debug($sales);
        return view('mypage.orderMonth', [
            'sales' => $sales,
            'year_month' => $year_month,
        ]);
    }
}
