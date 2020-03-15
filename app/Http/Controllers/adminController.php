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
use App\User;
use App\CategoryProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class adminController extends Controller
{
    public function userIndex(Request $request)
    {
        Log::debug($request);
        //並べかえ（降順/昇順が押された場合）
        $sortFlg = $request->sort;
        if (isset($sortFlg)) {
            if ($sortFlg == '1') {
                $users = User::latest()->get();
            } elseif ($sortFlg == '0') {
                $users = User::all();
            }
        } else {
            $users = User::all();
        }


        //キーワード検索
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            Log::debug('キーワード検索の処理に入ってる');
            $users = User::where('email', 'like', '%' . $keyword . '%')->get();
        }

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }



    public function userEdit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->group = $request->group;
        $user->save();
        return redirect()->route('admin.user')->with('flash_message', 'ユーザー情報を更新しました');
    }

    //削除前確認
    public function userDeleteConfirm(Request $request, $id)
    {
        Log::debug('<< deleteConfirm >>');
        Log::debug($request);
        Log::debug($id);

        $deleteIds[] = $request->get('delete_id');

        foreach ($deleteIds as $deleteId) {
            $user = User::find($deleteId);
        }

        return view('admin.users.delete', [
            'user' => $user,
        ]);
    }

    //削除
    public function userDelete(Request $request, $id)
    {
        Log::debug('<< deleteData >>');
        Log::debug($request);
        Log::debug($id);

        $deleteIds[] = $id;
        // GETパラメータが数字かどうかをチェックする
        // 事前にチェックしておくことでDBへの無駄なアクセスが減らせる（WEBサーバーへのアクセスのみで済む）
        if (!ctype_digit($id)) {
            return redirect('/admin/users')->with('flash_message', __('もう一度やり直してください'));
        }

        foreach ($deleteIds as $deleteId) {
            $user = User::find($deleteId);
            $user->delete();
        }

        return redirect('/admin/users')->with('flash_message', '削除しました');
    }


    // プロダクト一覧表示
    public function productIndex(Request $request)
    {
        Log::debug($request);
        //並べかえ（降順/昇順が押された場合）

        // ユーザー情報の取得
        $products = DB::table('products')
            ->join('users', 'products.user_id', '=', 'users_id')
            ->select('products.title', 'users.email',)
            ->get();

        $sortFlg = $request->sort;
        if (isset($sortFlg)) {
            if ($sortFlg == '1') {
                $products = $products::latest()->get();
            } elseif ($sortFlg == '0') {
                $products = $products::all();
            }
        } else {
            $products = $products::all();
        }


        //キーワード検索
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            Log::debug('キーワード検索の処理に入ってる');
            $products = Product::where('email', 'like', '%' . $keyword . '%')->get();
        }

        return view('admin.products.index', [
            'products' => $products,
        ]);
    }
}
