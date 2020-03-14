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

class LessonShowController extends Controller
{
    /**
     * レッスン表示
     */
    public function index($p_id, $l_id)
    {
        if (!ctype_digit($p_id)) {
            return redirect('/products')->with('flash_message', __('もう一度やり直してください'));
        }
        if (!ctype_digit($l_id)) {
            return redirect('/products')->with('flash_message', __('もう一度やり直してください'));
        }

        Log::debug('<<<<<<<<   LESSON >>>>>>>>>>>');

        //プロダクト情報取得
        $product = Product::find($p_id);

        //レッスン情報の取得
        $all_lessons = Lesson::where('product_id', $p_id)->get();
        $this_lesson = Lesson::where('product_id', $p_id)->where('number', $l_id)->first();

        Log::debug($this_lesson);

        // ユーザー情報の取得
        $user = DB::table('users')
            ->join('products', 'users.id', '=', 'products.user_id')
            ->select('users.id', 'users.account_name', 'users.pic')
            ->where('products.id', $p_id)
            ->get();

        return view('products.lesson', [
            'p_id' => $p_id,
            'l_id' => $l_id,
            'all_lessons' => $all_lessons,
            'this_lesson' => $this_lesson,
            'user' => $user,
            'product' => $product,
        ]);
    }
}
