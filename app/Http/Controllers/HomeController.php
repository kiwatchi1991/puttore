<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title =  'TOP';
        return view('index')->with('title', $title);
    }

    /**
     * パスワード変更 表示
     */
    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    /**
     * パスワード変更 処理
     */
    public function changePassword(Request $request)
    {
        //現在のパスワードが正しいかを調べる
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with('flash_message', '現在のパスワードが間違っています。');
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with('flash_message', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        //パスワードのバリデーション。新しいパスワードは6文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->route('mypage')->with('flash_message', 'パスワードを変更しました。');
    }
}
