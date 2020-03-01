<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Difficulty;
use App\Discount;
use App\Cart;
use App\Follow;
use App\Like;
use App\Lesson;
use App\CategoryProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Undefined;

class ProductsController extends Controller
{
    /**
     * 検索用絞り込み関数(カテゴリー)
     */
    public function getProductIdByCategories($categories){
        Log::debug('getProductIdByCategories発火');
        Log::debug('$categories');
        Log::debug($categories);

        $query = CategoryProduct::query();
        // Log::debug([$query]);
        foreach($categories as $id){
            $query->orWhere('category_id', $id);
        }
        return $query->get()->pluck("product_id");

        Log::debug('$query');

    }

    /**
     * マイページ
     */
    public function mypage(Request $request)
    {
        Log::debug('mypageコントローラー');
        Log::debug($request);

        // 検索ボックス用カテゴリーと難易度
        $category = Category::all();
        $difficult = Difficulty::all();

        $query  = Product::query();
        $tags   = $request->get('lang');
        Log::debug('$tagsの中身！');
        Log::debug($tags);

        if ($tags) {
            Log::debug('$tagsがあった！');
            $query->whereIn('id', $this->getProductIdByCategories($tags));
        }


        //プロダクト件数
        $all_products = Auth::user()->products()->get();
        //ログインユーザーのプロダクト（ページング）
        $products = Auth::user()->products()->paginate(10);

        //ページング用変数 始点
        $pageNum_from =  $products->currentPage()*10-9;
        //ページング用変数 終点
        $pageNum_to = $products->currentPage()*10;

        //価格をカンマ入れて表示

        //画像有無判定フラグ
        $is_image = false;
        if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
        $is_image = true;
        }

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
        'category' => $category,
        'difficult' => $difficult,
        ]);
    }

     /**
     * コンテンツ登録画面
     */
    public function new()
    {
        $category = Category::all();
        $difficult = Difficulty::all();
        return view('products.new',['category' => $category,'difficult' => $difficult]);

    }

    /**
     * 更新機能
     */

    public function update(Request $request, $id)
    {

        Log::debug('---------------------------------');
        Log::debug('<<<<<< product update >>>>>>>>>>>');
        Log::debug('---------------------------------');
        Log::debug('$request');
        Log::debug($request);
        // GETパラメータが数字かどうかをチェックする
        if (!ctype_digit($id)) {
            return redirect('/products/edit')->with('flash_message', __('Invalid operation was performed.'));
        }

        //画像登録
        $product = Product::find($id);
        $product->fill($request->all())->save();
        $isPic = $request->pic1;
        //画像に変更がない場合は処理をしない
        if($isPic){
            $path = $isPic->pic1->store('public/profile_images');
            $product->pic1 = str_replace('public/', '', $path);
            $product->save();
        }

        //レッスンの登録

        $lessons = $request->input('lessons');
        Log::debug('$lessons');
        Log::debug($lessons);
        foreach($lessons as $lesson){

            //hiddenのレッスンIDがあるかどうか（すでにあるレッスンかどうか）
            //すでにあるレッスンなら、更新
            if(isset($lesson['id'])){
                    $lesson1 = Lesson::find($lesson['id']);
                    Log::debug('<<<<<<<<<<<<  $lesson1 >>>>>>>>>>>>>>>>>>>>>>>');
                    Log::debug('<<<<<<<<<<<<  $lesson1 >>>>>>>>>>>>>>>>>>>>>>>');
                    Log::debug('<<<<<<<<<<<<  $lesson1 >>>>>>>>>>>>>>>>>>>>>>>');
                    Log::debug($lesson1);
                    Log::debug('<<<<<<<<<<<<  $lesson >>>>>>>>>>>>>>>>>>>>>>>');
                    Log::debug($lesson['number']);
                    Log::debug($lesson['title']);
                    Log::debug($lesson['lesson']);
                    Log::debug($lesson1->number);
                    Log::debug($lesson1->title);
                    Log::debug($lesson1->lesson);

                    $lesson1->number = $lesson['number'];
                    $lesson1->title = $lesson['title'];
                    $lesson1->lesson = $lesson['lesson'];
                    $lesson1->save();
                    //ない場合は、新規作成
                }else{
                    Log::debug('<<<<<<<<<<<<  New lesson >>>>>>>>>>>>>>>>>>>>>>>');
            $newLessons = new Lesson;
            $newLessons->product_id = $id;
            $newLessons->number = $lesson['number'];
            $newLessons->title = $lesson['title'];
            $newLessons->lesson = $lesson['lesson'];
            $newLessons->save();
            // Log::debug('$lessonsの内容');
            // Log::debug($lessons);
            // $product->lessons()->createMany($request->input('lessons'));

            }
        }

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
        Log::debug('$difficulties_nameの内容');
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

            // 言語中間テーブル
            $product->difficulties()->sync($difficulty_ids);


        Log::debug($request->discount_price);
        //割引価格の設定
        if(isset($request->discount_price)){
          Discount::where('product_id',$id)->delete();

          $discount_price = new Discount;
          $discount_price->product_id = $id;
          $discount_price->discount_price = $request->discount_price;
          $discount_price->start_date = $request->start_date;
          $discount_price->end_date = $request->end_date;
          $discount_price->save();
        }else{
          Log::debug('<<<<      割 引価格の入力がない！  >>>>>>>>>>>>>');
          Log::debug('<<<<      割 引価格の入力がない！  >>>>>>>>>>>>>');
          Log::debug('<<<<      割 引価格の入力がない！  >>>>>>>>>>>>>');
        }

        return redirect()->route('products.show',$id)->with('flash_message', __('Registered.'));
    }

    /**
     * コンテンツ登録
     */
    public function create(Request $request)
    {

        Log::debug('コントローラー：create');


        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'string|max:255',
            // 'lesson' => 'string|max:255',
            // 'free_flg' => 'string|max:255',
            // 'pic1' => 'string|max:255',
            // 'pic2' => 'string|max:255',
            // 'pic3' => 'string|max:255',
            // 'pic4' => 'string|max:255',
            // 'pic5' => 'string|max:255',
            // 'pic5' => 'string|max:255',
            ]);

            Log::debug('これからDBへデータ挿入');
            Log::debug($request);
            //おしえてもらったやりかた

            $product = new Product;
            Auth::user()->products()->save($product->fill($request->all()));
            Log::debug($request->pic1);
            $path = $request->pic1->store('public/profile_images');
            $product->pic1 = str_replace('public/', '', $path);

            $path = $request->pic2->store('public/profile_images');
            $product->pic2 = str_replace('public/', '', $path);

            $path = $request->pic3->store('public/profile_images');
            $product->pic3 = str_replace('public/', '', $path);

            $path = $request->pic4->store('public/profile_images');
            $product->pic4 = str_replace('public/', '', $path);
            
            $path = $request->pic5->store('public/profile_images');
            $product->pic5 = str_replace('public/', '', $path);
            $product->save();

            //1対多の登録
            $lessons = $request->input('lessons'); //postされたもののうち、lang属性のものだけ（＝カテゴリーIDの配列）
            Log::debug('$lessonsの内容');
            Log::debug($lessons);
            $product->lessons()->createMany($request->input('lessons'));

            //画像アップロード（これだけ単独で入れる）
            Log::debug('リクエストの中身確認');
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

                // 言語中間テーブル
                $product->difficulties()->sync($difficulty_ids);



        // リダイレクトする
        // その時にsessionフラッシュにメッセージを入れる
        return redirect('/products/mypage')->with('flash_message', __('Registered.'));
    }

    /**
     * 一覧機能
     */

    public function index(Request $request)
    {
        // 検索ボックス用
        $category = Category::all();
        $difficult = Difficulty::all();

        $categorieIds   = $request->get('lang');
        $difficultiesIds   = $request->get('difficult');

        /**
         * 検索機能
         */


        //カテゴリーと難易度両方あるパターン
        if($request->get('lang') && $request->get('difficult')){
            //カテゴリー
            $products = Product::whereHas('categories', function($query) use ($categorieIds) {
                $query->whereIn('category_id', $categorieIds);
            })
            //難易度
            ->whereHas('difficulties', function($query) use ($difficultiesIds) {
                $query->whereIn('difficulty_id', $difficultiesIds);
                })->paginate(10);
        //カテゴリーしかないパターン
        } else if($request->get('lang')) {
        $products = Product::whereHas('categories', function($query) use ($categorieIds) {
            $query->whereIn('category_id', $categorieIds);})->paginate(10);

        //難易度しかないパターン
        } else if($request->get('difficult')){
        $products = Product::whereHas('difficulties', function($query) use ($difficultiesIds) {
            $query->whereIn('difficulty_id', $difficultiesIds);
            })->paginate(10);

        //両方ないパターン（初期表示）
        }  else {
            $products = Product::paginate(10);
        }

        //プロダクト件数
        $all_products = Product::all();
        //全プロダクト（ページング）
        // $products = Product::paginate(10);

        //ページング用変数 始点
        $pageNum_from =  $products->currentPage()*10-9;
        //ページング用変数 終点
        $pageNum_to = $products->currentPage()*10;

        //価格をカンマ入れて表示

        //画像有無判定フラグ
        $is_image = false;
        if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
        $is_image = true;
        }

        $product_category = Product::all();
        $product_difficulty = Product::all();

        return view('products.index',[
        'products' => $products,
        'product_categories' => $product_category,
        'product_difficulties' => $product_difficulty,
        'all_products'=>$all_products,
        'pageNum_from' => $pageNum_from,
        'pageNum_to' => $pageNum_to,
        'is_image' => $is_image,
        'category' => $category,
        'difficult' => $difficult,
        ]);

        // return redirect('/products')->with('flash_message', __('検索したよ'));

    }

    /**
     * 詳細表示機能
     */
    public function shows($id)
    {

        // if (!ctype_digit($id)) {
        //     return redirect('/products')->with('flash_message', __('Invalid operation was performed.'));
        // }

        Log::debug('SHOW!!!');
        $product = Product::find($id);
        
        // 購入済みかどうかを判断（これによって表示するページが違う）
        $isOrder = DB::table('orders')
        ->where('user_id',Auth::user()->id)
        ->where('product_id',$id)
        ->get();
        Log::debug('<<<<<<<<<  isOrder   >>>>>>>>>>>>>>>>>>');
        Log::debug($isOrder);
        


        // ユーザー情報の取得
        $user = DB::table('users')
        ->join('products', 'users.id', '=', 'products.user_id')
        ->select('users.id', 'users.account_name')
        ->where('products.id',$id)
        ->get();

        Log::debug('$user');
        Log::debug($user);

        $categoryAndDifficulty = Product::all();

        //各種情報取得
        $product_id = $id;
        //カート情報取得
        $my_id = Auth::user()->id;
        $cart = Cart::where('user_id',$my_id)->where('product_id',$product_id)->count();

        //フォロー情報取得
        $user_id = $user[0]->id;
        $follow = Follow::where('followed_user_id',$user_id)->where('follow_user_id',Auth::user()->id)->count();

        // お気に入り情報取得
        $liked = Like::where('product_id',$product_id)->where('user_id',Auth::user()->id)->count();

        //　割引価格情報取得
        $discount_price = Discount::where('product_id',$product_id)->first();
        Log::debug('$discount_price');
        Log::debug($discount_price);

        //　レッスン情報取得
        $lessons = Lesson::where('product_id',$product_id)->get();

   
        
        //　画像情報のみ取得
        $product_imgs = [];
        $product_imgs[] = $product->pic1;
        $product_imgs[] = $product->pic2;
        $product_imgs[] = $product->pic3;
        $product_imgs[] = $product->pic4;
        $product_imgs[] = $product->pic5;
        
        
        Log::debug('$product_imgs');
        Log::debug($product_imgs);
        Log::debug($product);


        return view('products.show', [
        'product' => $product,
        'user' => $user,
        'categoryAndDifficulty' => $categoryAndDifficulty,
        'cart' => $cart,
        'follow' => $follow,
        'liked' => $liked,
        'discount_price' => $discount_price,
        'product_imgs' => $product_imgs,
        'lessons' => $lessons,
        'isOrder' => $isOrder,
        ]);
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

        //　割引価格情報取得
        $discount_price = Discount::where('product_id',$id)->first();
        Log::debug('$discount_price');
        Log::debug($discount_price);

        $category = Category::all();
        $difficult = Difficulty::all();
        $difficult = Difficulty::all();
        $lessons= Lesson::where('product_id',$id)->get();

        return view('products.edit', [
            'product' => $product,
            'category' => $category,
            'difficult' => $difficult,
            'lessons' => $lessons,
            'discount_price' => $discount_price,
            ]);
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
