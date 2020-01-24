<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use Illuminate\Support\Facades\Auth;
use Log;

class ContentsController extends Controller
{
    public function new()
    {
        return view('contents.new');
    }
    public function create(Request $request)
    {
        Log::debug('あああ');
        $request->validate([
            // 'title' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'string|max:255',
            'pic' => 'string|max:255',
            // 'category_name' => 'required|string|max:255',
            // 'problem0' => 'required|string|max:255',
            // 'problem1' => 'string|max:255',
            // 'problem2' => 'string|max:255',
            // 'problem3' => 'string|max:255',
            // 'problem4' => 'string|max:255',
            // 'problem5' => 'string|max:255',
            // 'problem6' => 'string|max:255',
            // 'problem7' => 'string|max:255',
            // 'problem8' => 'string|max:255',
            // 'problem9' => 'string|max:255',
        ]);

        //モデルを使って、DBに登録する値をセット
        $content = new Content;

        // fillを使って一気にいれるか
        // $fillableを使っていないと変なデータが入り込んだ場合に勝手にDBが更新されてしまうので注意！
        Log::debug('これからDBへデータ挿入');
        Auth::user()->contents()->save($content->fill($request->all()));
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
        $contents = Content::all();
        return view('contents.index', ['view_contents' => $contents]);
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
