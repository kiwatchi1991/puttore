<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Log;


class ProductsController extends Controller
{
    public function new()
    {
        return view('contents.new');
    }

    public function create(Request $request)
    {
        Log::debug('あああ');
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


        // リダイレクトする
        // その時にsessionフラッシュにメッセージを入れる
        return redirect('/contents/new')->with('flash_message', __('Registered.'));
    }


    /**
     * 一覧機能
     */

    public function index()
    {
        $product = Product::all();
        return view('contents.index', ['view_products' => $product]);
    }

    /**
     * 編集機能
     */
    public function edit($id)
    {
        // GETパラメータが数字かどうかをチェックする
        // 事前にチェックしておくことでDBへの無駄なアクセスが減らせる（WEBサーバーへのアクセスのみで済む）
        if (!ctype_digit($id)) {
            return redirect('/contents/new')->with('flash_message', __('Invalid operation was performed.'));
        }

        $content = Content::find($id);
        return view('contents.edit', ['content' => $content]);
    }

    /**
     * 更新機能
     */
    public function update(Request $request, $id)
    {
        // GETパラメータが数字かどうかをチェックする
        if (!ctype_digit($id)) {
            return redirect('/contents/new')->with('flash_message', __('Invalid operation was performed.'));
        }

        $drill = Content::find($id);
        $drill->fill($request->all())->save();

        return redirect('/contents')->with('flash_message', __('Registered.'));
    }

    /**
     * 削除機能
     */

    public function delete($id)
    {
        // GETパラメータが数字かどうかをチェックする
        if (!ctype_digit($id)) {
            return redirect('/contents/new')->with('flash_message', __('Invalid operation was performed.'));
        }

        // $drill = Drill::find($id);
        // $drill->delete();

        // こう書いた方がスマート
        Content::find($id)->delete();

        return redirect('/contents')->with('flash_message', __('Deleted.'));
    }

    /**
     * マイページ
     */
    public function mypage()
    {
        $contents = Auth::user()->contents()->get();
        return view('contents.mypage', compact('contents'));
    }
}
