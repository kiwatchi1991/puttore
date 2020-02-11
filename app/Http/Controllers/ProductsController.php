<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Difficulty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Log;


class ProductsController extends Controller
{
    public function new()
    {
        $category = Category::all();
        $difficult = Difficulty::all();
        return view('products.new',['category' => $category,'difficult' => $difficult]);

        // return view('products.edit', ['product' => $product]);
    }

    public function create(Request $request)
    {
        Log::debug('コントローラー：create');
        
        
        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'string|max:255',
            'lesson' => 'string|max:255',
            // 'free_flg' => 'string|max:255',
            // 'pic1' => 'string|max:255',
            // 'pic2' => 'string|max:255',
            // 'pic3' => 'string|max:255',
            // 'pic4' => 'string|max:255',
            // 'pic5' => 'string|max:255',
            // 'pic5' => 'string|max:255',
            ]);
            
            //モデルを使って、DBに登録する値をセット
            $product = new Product;
            
            // fillを使って一気にいれるか
            // $fillableを使っていないと変なデータが入り込んだ場合に勝手にDBが更新されてしまうので注意！
            Log::debug('これからDBへデータ挿入');
            Auth::user()->products()->save($product->fill($request->all()));
            Log::debug('DBへデータ挿入完了');


            // 言語の登録
            $categories_name = $request->input('lang'); //postされたもののうち、lang属性のものだけ（＝カテゴリーIDの配列）
    
            Log::debug('$productの内容');
            Log::debug([$product]);
            Log::debug('$categories_nameの内容');
            Log::debug($categories_name);
            
            $category_ids = [];
            foreach ($categories_name as $category_name) {
                if(!empty($category_name)){
                     $category = Category::firstOrCreate([
                         'id' => $category_name,
                         ]);
    
                         Log::debug('$categoryの内容');
                         Log::debug($category);
    
                     $category_ids[] = $category->id;
                    }
                }
            Log::debug('$category_ids[]の内容');
            Log::debug($category_ids);
    
            // 言語中間テーブル
            $product->categories()->sync($category_ids);  

            
            // 難易度の登録
            $difficulties_name = $request->input('difficult'); //postされたもののうち、lang属性のものだけ（＝カテゴリーIDの配列）

            Log::debug('$productの内容');
            Log::debug([$product]);
            Log::debug('$categories_nameの内容');
            Log::debug($difficulties_name);
            
            $difficulty_ids = [];
            foreach ($difficulties_name as $difficulty_name) {
                if(!empty($difficulty_name)){
                        $difficulty = Category::firstOrCreate([
                            'id' => $difficulty_name,
                            ]);
    
                            Log::debug('$difficultyの内容');
                            Log::debug($difficulty);
    
                        $difficulty_ids[] = $difficulty->id;
                    }
                }
            Log::debug('$difficulty_ids[]の内容');
            Log::debug($difficulty_ids);
    
            // 言語中間テーブル
            $product->difficulties()->sync($difficulty_ids);  
            // return redirect('/products/mypage')->with('success', '登録しました');

        //画像アップロード
        $request->photo->storeAs('public/profile_images', Auth::id() . '.jpg');

        // リダイレクトする
        // その時にsessionフラッシュにメッセージを入れる
        return redirect('/products/mypage')->with('flash_message', __('Registered.'));
    }
    
    /**
     * マイページ
     */
    public function mypage()
    {
        //プロダクト件数
        $all_products = Auth::user()->products()->get();
        //ログインユーザーのプロダクト件数
        $products = Auth::user()->products()->paginate(10);

        //ページング用変数 始点
        $pageNum_from =  $products->currentPage()*10-9;
        //ページング用変数 終点
        $pageNum_to = $products->currentPage()*10;
        
        //価格をカンマ入れて表示
        // $price = DB::select('select * from products where active = ?', [1]);

        //画像有無判定フラグ
        $is_image = false;
        if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
        $is_image = true;
        }

        Log::debug('products_id中身 : '.$products);
        $product_category = Product::all();
        $product_difficulty = Product::all();



        return view('products.mypage',[
        'products' => $products,
        'product_categories' => $product_category,
        'product_difficulties' => $product_difficulty,
        'all_products'=>$all_products,
        'pageNum_from' => $pageNum_from,
        'pageNum_to' => $pageNum_to,
        'is_image' => $is_image,
        ]);

        
        // return view('products.mypage', compact('products,categories'));

    }
    
    /**
     * 一覧機能
     */

    public function index()
    {
        $product = Product::all();
        return view('products.index', ['view_products' => $product]);
    }

    /**
     * 編集機能
     */
    public function edit($id)
    {
        // GETパラメータが数字かどうかをチェックする
        // 事前にチェックしておくことでDBへの無駄なアクセスが減らせる（WEBサーバーへのアクセスのみで済む）
        if (!ctype_digit($id)) {
            return redirect('/products/new')->with('flash_message', __('Invalid operation was performed.'));
        }

        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
    }

    /**
     * 更新機能
     */
    public function update(Request $request, $id)
    {
        // GETパラメータが数字かどうかをチェックする
        if (!ctype_digit($id)) {
            return redirect('/products/new')->with('flash_message', __('Invalid operation was performed.'));
        }

        $drill = Content::find($id);
        $drill->fill($request->all())->save();

        return redirect('/products')->with('flash_message', __('Registered.'));
    }

    /**
     * 削除機能
     */

    public function delete($id)
    {
        // GETパラメータが数字かどうかをチェックする
        if (!ctype_digit($id)) {
            return redirect('/products/new')->with('flash_message', __('Invalid operation was performed.'));
        }

        // $drill = Drill::find($id);
        // $drill->delete();

        // こう書いた方がスマート
        Product::find($id)->delete();

        return redirect('/products')->with('flash_message', __('Deleted.'));
    }

}
