<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;

use App\Product;
use App\Category;
use App\Difficulty;
use App\Discount;
use App\Cart;
use App\Follow;
use App\Like;
use App\Lesson;
use App\CategoryProduct;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Undefined;

class ProductsController extends Controller
{
    /**
     * コンテンツ登録画面
     */
    public function new()
    {
        Log::debug('<<<<        new  >>>>>>>>>>');

        $category = Category::all();
        $difficult = Difficulty::all();

        // $lessons = new Lesson;
        $collect = collect([]);
        if (old('lessons')) {
            foreach (old('lessons') as $l) {
                $lesson = new Lesson($l);
                $collect->push($lesson);
            }
        } else {
            $collect->push(new Lesson());
        }
        $lessons = $collect;
        return view('products.new', [
            'category' => $category,
            'difficult' => $difficult,
            'lessons' => $lessons,
        ]);
    }

    /**
     * 更新機能
     */

    public function update(CreateProductRequest $request, $id)
    {

        Log::debug('<<<<<< product update >>>>>>>>>>>');
        // GETパラメータが数字かどうかをチェックする
        if (!ctype_digit($id)) {
            return redirect('/products/edit')->with('flash_message', __('もう一度やり直してください'));
        }

        //画像登録
        $product = Product::find($id);

        $isFlgPic1 = $request->flgpic1;
        $isFlgPic2 = $request->flgpic2;
        $isFlgPic3 = $request->flgpic3;
        $isFlgPic4 = $request->flgpic4;
        $isFlgPic5 = $request->flgpic5;
        $isFlgPic6 = $request->flgpic6;

        //画像の削除がされていたら既存画像とDBカラムを削除
        if ($isFlgPic1) {
            Storage::delete('public/' . $product->pic1);
            $product->pic1 = '';
        }
        if ($isFlgPic2) {
            Storage::delete('public/' . $product->pic2);
            $product->pic2 = '';
        }
        if ($isFlgPic3) {
            Storage::delete('public/' . $product->pic3);
            $product->pic3 = '';
        }
        if ($isFlgPic4) {
            Storage::delete('public/' . $product->pic4);
            $product->pic4 = '';
        }
        if ($isFlgPic5) {
            Storage::delete('public/' . $product->pic5);
            $product->pic5 = '';
        }
        if ($isFlgPic6) {
            Storage::delete('public/' . $product->pic6);
            $product->pic6 = '';
        }

        // 画像の更新がある場合はDBのデータを削除
        $isPic1 = $request->pic1;
        $isPic2 = $request->pic2;
        $isPic3 = $request->pic3;
        $isPic4 = $request->pic4;
        $isPic5 = $request->pic5;
        $isPic6 = $request->pic6;

        $isPic1 && Storage::delete('public/' . $product->pic1);
        $isPic2 && Storage::delete('public/' . $product->pic2);
        $isPic3 && Storage::delete('public/' . $product->pic3);
        $isPic4 && Storage::delete('public/' . $product->pic4);
        $isPic5 && Storage::delete('public/' . $product->pic5);
        $isPic6 && Storage::delete('public/' . $product->pic6);

        //データを全て更新
        $product->fill($request->all())->save();

        //画像に変更がない場合は処理をしない
        if ($isPic1) {
            $path = $isPic1->store('public/product_images');
            $product->pic1 = str_replace('public/', '', $path);
        }
        if ($isPic2) {
            $path = $isPic2->store('public/product_images');
            $product->pic2 = str_replace('public/', '', $path);
        }
        if ($isPic3) {
            $path = $isPic3->store('public/product_images');
            $product->pic3 = str_replace('public/', '', $path);
        }
        if ($isPic4) {
            $path = $isPic4->store('public/product_images');
            $product->pic4 = str_replace('public/', '', $path);
        }
        if ($isPic5) {
            $path = $isPic5->store('public/product_images');
            $product->pic5 = str_replace('public/', '', $path);
        }
        if ($isPic6) {
            $path = $isPic6->store('public/product_images');
            $product->pic6 = str_replace('public/', '', $path);
        }
        $product->save();

        //レッスンの登録

        $lessons = $request->input('lessons');

        foreach ($lessons as $lesson) {
            //hiddenのレッスンIDがあるかどうか（すでにあるレッスンかどうか）
            //すでにあるレッスンなら、更新
            if (isset($lesson['id'])) {
                $lesson1 = Lesson::find($lesson['id']);

                $lesson1->number = $lesson['number'];
                $lesson1->title = $lesson['title'];
                $lesson1->lesson = $lesson['lesson'];
                $lesson1->save();
                //ない場合は、新規作成
            } else {
                Log::debug('<<<<<<<<<<<<  New lesson >>>>>>>>>>>');
                $newLessons = new Lesson;
                $newLessons->product_id = $id;
                $newLessons->number = $lesson['number'];
                $newLessons->title = $lesson['title'];
                $newLessons->lesson = $lesson['lesson'];
                $newLessons->save();
            }
        }

        // 言語の登録
        $categories_name = $request->input('lang'); //postされたもののうち、lang属性のものだけ（＝カテゴリーIDの配列）

        $category_ids = [];
        foreach ($categories_name as $category_name) {
            if (!empty($category_name)) {
                $category = Category::firstOrCreate([
                    'id' => $category_name,
                ]);
                $category_ids[] = $category->id;
            }
        }

        // 言語中間テーブル
        $product->categories()->sync($category_ids);

        // 難易度の登録
        $difficulties_name = $request->input('difficult'); //postされたもののうち、lang属性のものだけ（＝カテゴリーIDの配列）

        $difficulty_ids = [];
        foreach ($difficulties_name as $difficulty_name) {
            if (!empty($difficulty_name)) {
                $difficulty = Category::firstOrCreate([
                    'id' => $difficulty_name,
                ]);
                $difficulty_ids[] = $difficulty->id;
            }
        }

        // 言語中間テーブル
        $product->difficulties()->sync($difficulty_ids);

        //割引価格の設定
        if (isset($request->discount_price)) {
            Discount::where('product_id', $id)->delete();

            $discount_price = new Discount;
            $discount_price->product_id = $id;
            $discount_price->discount_price = $request->discount_price;
            $discount_price->start_date = Carbon::parse($request->start_date);
            $discount_price->end_date = Carbon::parse($request->end_date);
            $discount_price->save();
        } else {
            Log::debug('<<<<<<<    割引価格の入力なし   >>>>>>>>>>>>>');
        }

        //下書きの時は、公開フラグを1にする
        if ($request->postType == 'draft') {
            $product->open_flg = 1;
            $product->save();
            return redirect()->route('products.show', $id)->with('flash_message', '作品を下書き保存しました');
        } else {
            $product->open_flg = 0;
            $product->save();
            return redirect()->route('products.show', $id)->with('flash_message', '作品を更新して公開しました');
        }
    }

    /**
     * コンテンツ登録
     */
    public function create(CreateProductRequest $request)
    {

        Log::debug('：<<<<   create   >>>>>>>>>');

        $product = new Product;
        Auth::user()->products()->save($product->fill($request->all()));
        Log::debug($request->pic1);
        if ($request->pic1) {
            $path = $request->pic1->store('public/product_images');
            $product->pic1 = str_replace('public/', '', $path);
            $product->save();
        }
        if ($request->pic2) {

            $path = $request->pic2->store('public/product_images');
            $product->pic2 = str_replace('public/', '', $path);
            $product->save();
        }
        if ($request->pic3) {

            $path = $request->pic3->store('public/product_images');
            $product->pic3 = str_replace('public/', '', $path);
            $product->save();
        }

        if ($request->pic4) {
            $path = $request->pic4->store('public/product_images');
            $product->pic4 = str_replace('public/', '', $path);
            $product->save();
        }

        if ($request->pic5) {
            $path = $request->pic5->store('public/product_images');
            $product->pic5 = str_replace('public/', '', $path);
            $product->save();
        }
        if ($request->pic6) {
            $path = $request->pic6->store('public/product_images');
            $product->pic6 = str_replace('public/', '', $path);
            $product->save();
        }

        //1対多の登録
        $lessons = $request->input('lessons');
        $product->lessons()->createMany($request->input('lessons'));

        // 言語の登録
        $categories_name = $request->input('lang');

        $category_ids = [];
        foreach ($categories_name as $category_name) {
            if (!empty($category_name)) {
                $category = Category::firstOrCreate([
                    'id' => $category_name,
                ]);

                $category_ids[] = $category->id;
            }
        }

        // 言語中間テーブル
        $product->categories()->sync($category_ids);


        // 難易度の登録
        $difficulties_name = $request->input('difficult'); //postされたもののうち、lang属性のものだけ（＝カテゴリーIDの配列）

        $difficulty_ids = [];
        foreach ($difficulties_name as $difficulty_name) {
            if (!empty($difficulty_name)) {
                $difficulty = Category::firstOrCreate([
                    'id' => $difficulty_name,
                ]);
                $difficulty_ids[] = $difficulty->id;
            }
        }

        // 言語中間テーブル
        $product->difficulties()->sync($difficulty_ids);


        //下書きの時は、公開フラグを1にする
        if ($request->postType == 'draft') {
            $product->open_flg = 1;
            $product->save();
            return redirect()->route('products.show', $product->id)->with('flash_message', '作品を下書き保存しました');
        } else {
            $product->open_flg = 0;
            $product->save();
            return redirect()->route('products.show', $product->id)->with('flash_message', '作品を公開しました');
        }
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
        if ($request->get('lang') && $request->get('difficult')) {
            //カテゴリー
            $products = Product::whereHas('categories', function ($query) use ($categorieIds) {
                $query->whereIn('category_id', $categorieIds);
            })
                //難易度
                ->whereHas('difficulties', function ($query) use ($difficultiesIds) {
                    $query->whereIn('difficulty_id', $difficultiesIds);
                })->where('open_flg', 0)->latest()->paginate(12);
            //カテゴリーしかないパターン
        } else if ($request->get('lang')) {
            $products = Product::whereHas('categories', function ($query) use ($categorieIds) {
                $query->whereIn('category_id', $categorieIds);
            })->where('open_flg', 0)->latest()->paginate(12);

            //難易度しかないパターン
        } else if ($request->get('difficult')) {
            $products = Product::whereHas('difficulties', function ($query) use ($difficultiesIds) {
                $query->whereIn('difficulty_id', $difficultiesIds);
            })->where('open_flg', 0)->latest()->paginate(12);

            //両方ないパターン（初期表示）
        } else {
            $products = Product::where('open_flg', 0)->latest()->paginate(12);
        }

        //画像有無判定フラグ
        $is_image = false;
        if (Storage::disk('local')->exists('public/product_images/' . Auth::id() . '.jpg')) {
            $is_image = true;
        }

        $product_category = Product::all();
        $product_difficulty = Product::all();

        return view('products.index', [
            'products' => $products,
            'product_categories' => $product_category,
            'product_difficulties' => $product_difficulty,
            'is_image' => $is_image,
            'category' => $category,
            'difficult' => $difficult,
            'categorieIds' => $categorieIds,
            'difficultiesIds' => $difficultiesIds,
        ]);
    }

    /**
     * 詳細表示機能
     */
    public function shows($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/products')->with('flash_message', __('もう一度やり直してください'));
        }

        Log::debug('SHOW!!!');
        $product = Product::find($id);

        // 購入済みかどうかを判断（これによって表示するページが違う）

        if (Auth::user()) {
            $myOrder = DB::table('orders')
                ->where('user_id', Auth::user()->id)
                ->where('product_id', $id);
            $isOrder = ($myOrder->count() > 0) ? true : false;
        } else {
            $isOrder = false;
        }

        // ユーザー情報の取得
        $user = DB::table('users')
            ->join('products', 'users.id', '=', 'products.user_id')
            ->select('users.id', 'users.account_name', 'users.pic')
            ->where('products.id', $id)
            ->get();

        $categoryAndDifficulty = Product::all();

        //各種情報取得
        $product_id = $id;

        // お気に入り情報取得
        $liked = 0;
        if (Auth::user()) {
            $liked = Like::where('product_id', $product_id)->where('user_id', Auth::user()->id)->count();
        }

        //　割引価格情報取得
        $discount_price = Discount::where('product_id', $product_id)
            ->where('start_date', '<', Carbon::now())
            ->where('end_date', '>', Carbon::now())
            ->first();

        //　レッスン情報取得
        $lessons = Lesson::where('product_id', $product_id)->get();



        //　画像情報のみ取得（pic１になければ表示しない）
        $product_imgs = [];
        if ($product->pic1) {
            $product_imgs[] = $product->pic1;
            $product_imgs[] = $product->pic2;
            $product_imgs[] = $product->pic3;
            $product_imgs[] = $product->pic4;
            $product_imgs[] = $product->pic5;
            $product_imgs[] = $product->pic6;
        }
        Log::debug('$product_imgs');
        Log::debug($product_imgs);

        // payjp公開鍵
        $payjp_pk = config('services.payjp.pk_live_p');

        return view('products.show', [
            'product' => $product,
            'user' => $user,
            'categoryAndDifficulty' => $categoryAndDifficulty,
            'liked' => $liked,
            'discount_price' => $discount_price,
            'product_imgs' => $product_imgs,
            'lessons' => $lessons,
            'isOrder' => $isOrder,
            'payjp_pk' => $payjp_pk,
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
            return redirect('/products/new')->with('flash_message', __('もう一度やり直してください'));
        }

        $product = Product::find($id);

        //自分以外は権限を持たない
        if ($product->user_id !== Auth::user()->id) {
            return redirect('/')->with('flash_message', __('権限がありません'));
        }

        //　割引価格情報取得
        $discount_price = Discount::where('product_id', $id)
            ->where('end_date', '>', Carbon::now())
            ->first();

        $category = Category::all();
        $difficult = Difficulty::all();
        $difficult = Difficulty::all();
        $lessons = null;
        if (old('lessons')) {
            $collect = collect([]);
            foreach (old('lessons') as $l) {
                if (isset($l['id']) && $lesson = $product->lessons()->find($l['id'])) {
                    $lesson->fill($l);
                } else {
                    $lesson = new Lesson($l);
                }
                $collect->push($lesson);
            }
            $lessons = $collect;
        } else {
            $lessons = Lesson::where('product_id', $id)->get();
        }

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
            return redirect('/products')->with('flash_message', __('もう一度やり直してください'));
        }

        $product = Product::find($id);
        $product->delete();

        return redirect('/products')->with('flash_message', '削除しました');
    }

    /**
     * レッスン削除（非同期）
     */
    public function ajaxLessonDelete(Request $request)
    {
        Log::debug('<<<<<<<<   ajaxLessonDelete  >>>>>>>>>>>>>');

        $lesson_id = $request->lessonId;

        $delete_target_lesson = Lesson::where('id', $lesson_id);
        if ($delete_target_lesson) {
            Log::debug('<<<<<<<< LESSON　削除処理　>>>>>>>>>>>>>');
            $delete_target_lesson->delete();
            return response()->json();
        }
    }

    /**
     * 銀行情報の有無確認（非同期）
     */
    public function ajaxBankConfirm(Request $request)
    {
        Log::debug('message');

        $user = Auth::user();

        $hasBankConfirm =
            isset($user->bank_code) &&
            isset($user->bank_branch_code) &&
            isset($user->bank_account_holder_name) &&
            isset($user->bank_account_type) &&
            isset($user->bank_account_number) &&
            isset($user->payjp_tenant_id);

        return response()->json($hasBankConfirm);
    }
}
