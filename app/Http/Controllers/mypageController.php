<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateBankInfoRequest;

use Illuminate\Support\Carbon;
use App\User;
use App\Like;
use App\SystemCommission;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Auth;
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
            ->get();

        return view('mypage.product', [
            'products' => $products,
            'product_categories' => $product_category,
            'product_difficulties' => $product_difficulty,
            'drafts' => $drafts,
            'buy_products' => $buy_products,
        ]);
    }

    //=============================================
    //==========        販売履歴ページ     ==========
    //=============================================
    public function sold(Request $request)
    {
        //売上履歴
        $sold_data = Order::query()
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::user()->id)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.created_at as created_at', 'sale_price', 'products.id as p_id', 'products.name', 'users.id as u_id', 'users.account_name', 'users.pic')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mypage.sold', [
            'sold_data' => $sold_data,
        ]);
    }

    //=============================================
    //==========       下書き　ページ     ==========
    //=============================================

    public function draft(Request $request)
    {

        $products = Product::where('user_id', Auth::user()->id)
            ->where('open_flg', 1)
            ->latest()->get();

        Log::debug(' <<<<<<   マイページ（　下書き　）   >>>>>>>');

        $product_category = Product::all();
        $product_difficulty = Product::all();

        return view('mypage.draft', [
            'products' => $products,
            'product_categories' => $product_category,
            'product_difficulties' => $product_difficulty,
        ]);
    }
    //=============================================
    //==========       お気に入り　ページ     ==========
    //=============================================
    public function like()
    {
        $likeIds = Like::where('likes.user_id', Auth::user()->id)->get('product_id');
        $products = Product::whereIn('id', $likeIds)->get();

        Log::debug(' <<<<<<   マイページ（　お気に入り　）   >>>>>>>');

        $product_category = Product::all();
        $product_difficulty = Product::all();

        return view('mypage.like', [
            'products' => $products,
            'product_categories' => $product_category,
            'product_difficulties' => $product_difficulty,
        ]);
    }

    //=============================================
    //==========       購入作品　ページ     ==========
    //=============================================
    public function buy()
    {
        $productsIds =  Order::where('orders.user_id', Auth::user()->id)->get('product_id');
        $products = Product::whereIn('id', $productsIds)->get();

        Log::debug(' <<<<<<   マイページ（ 購入作品　）   >>>>>>>');

        $product_category = Product::all();
        $product_difficulty = Product::all();

        return view('mypage.buy', [
            'products' => $products,
            'product_categories' => $product_category,
            'product_difficulties' => $product_difficulty,
        ]);
    }
    //=============================================
    //==========       出品作品　ページ     ==========
    //=============================================
    public function sale(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)
            ->where('open_flg', 0)
            ->latest()->get();

        Log::debug(' <<<<<<   マイページ（ 出品作品　）   >>>>>>>');

        $product_category = Product::all();
        $product_difficulty = Product::all();

        return view('mypage.sale', [
            'products' => $products,
            'product_categories' => $product_category,
            'product_difficulties' => $product_difficulty,
        ]);
    }

    //=============================================
    //=====    （銀行情報）編集　ページ     ==========
    //=============================================
    public function edit()
    {
        $id = Auth::user()->id;
        $bank = User::find($id);

        return view('mypage.edit', [
            'id' => $id,
            'bank' => $bank,
        ]);
    }

    //=============================================
    //=====    （銀行情報）更新　　　　　     ==========
    //=============================================
    public function update(UpdateBankInfoRequest $request, $id)
    {
        Log::debug('<<<<   update    >>>>>>');
        Log::debug('<<<<   request    >>>>>>');
        Log::debug($request);

        $user = User::find($id);
        try {
            $payjp_sk = config('services.payjp.sk_live_p');
            $tenant_id = $user->payjp_tenant_id;

            \Payjp\Payjp::setApiKey($payjp_sk);

            if (empty($tenant_id)) {
                // ユーザーのpayjp_tenand_idカラムにデータがない場合、テナント新規作成
                $tenant = \Payjp\Tenant::create(
                    array(
                        //テナントidは指定せず、自動生成させる
                        "name" => $user->email,
                        "platform_fee_rate" => SystemCommission::find(1)->commission_rate * 100,
                        "minimum_transfer_amount" => 5000,
                        "bank_account_holder_name" => $request->bank_account_holder_name,
                        "bank_code" => $request->bank_code,
                        "bank_branch_code" => $request->bank_branch_code,
                        "bank_account_type" => $request->bank_account_type === '0' ? "普通" : "当座",
                        "bank_account_number" => $request->bank_account_number,
                    )
                );
            } else {
                // ユーザーのpayjp_tenand_idカラムにデータが存在する場合は、テナント情報の更新
                $tenant = \Payjp\Tenant::retrieve($tenant_id);

                $tenant->bank_account_holder_name = $request->bank_account_holder_name;
                $tenant->bank_code = $request->bank_code;
                $tenant->bank_branch_code = $request->bank_branch_code;
                $tenant->bank_account_type = $request->bank_account_type === '0' ? "普通" : "当座";
                $tenant->bank_account_number = $request->bank_account_number;
                $tenant->save();
            }
        } catch (\Payjp\Error\Card $e) {
            //
            return redirect()->route('mypage')->with('flash_message', 'テナント情報の登録に失敗しました。');
        }
        $user->payjp_tenant_id = $tenant->id;
        $user->fill($request->all())->save();

        return redirect()->route('mypage')->with('flash_message', '口座情報を変更しました');
    }

    /**
     * 注文管理機能
     */

    public function order()
    {
        $user = Auth::user();
        $tenant_id = $user->payjp_tenant_id;

        //テナントidが存在しない場合は、アカウント設定ページへリダイレクトさせる
        if (empty($tenant_id)) {
            return redirect()->route('mypage')->with('flash_message', 'アカウント設定ページより、銀行情報を登録してください');
        }
        //========  今月の売上 ==============
        $payjp_sk = config('services.payjp.sk_live_p');
        \Payjp\Payjp::setApiKey($payjp_sk);

        $this_month_charges = \Payjp\Charge::all(array(
            "tenant" => $tenant_id,
            "since" => strtotime(Carbon::now()->startOfMonth()) //月初以降
        ))["data"];

        $this_month_amount =
            array_sum(
                array_column(
                    array_filter($this_month_charges, function ($arr) {
                        // 返金済みのもの（refunded === true）は除外する
                        return $arr->refunded === false;
                    }),
                    "amount" //array_columnの第二引数
                )
            );


        //=========   未振込売上履歴  ==============
        $all_transfer = (array)\Payjp\TenantTransfer::all(array(
            "tenant" => $tenant_id,
        ))["data"];
        $filter = array_filter($all_transfer, function ($arr) {
            return $arr->status !== "paid";
        });
        $untransferred_sale = $filter[0];

        //==========  振込履歴  ==============
        $paids = array_filter($all_transfer, function ($arr) {
            return $arr->status === "paid";
        });

        return view('mypage.order', [
            'this_month_amount' => $this_month_amount,
            'untransferred_sale' => $untransferred_sale,
            'user' => $user,
            'paids' => $paids,
            'filter' => $filter,
        ]);
    }

    public function getSampleData()
    {
        $user = Auth::user();
        $tenant_id = $user->payjp_tenant_id;

        $payjp_sk = config('services.payjp.sk_live_p');
        \Payjp\Payjp::setApiKey($payjp_sk);

        $all_transfer = (array)\Payjp\TenantTransfer::all(array(
            // "tenant" => $tenant_id,
            "tenant" => "ten_e1c93880cbe965d7634427feb032",
        ))["data"];
        $filter = array_filter($all_transfer, function ($arr) {
            return $arr->status !== "paid";
        });

        // return response()->json($filter[0]->amount);
        return view('mypage.data');
    }
}
