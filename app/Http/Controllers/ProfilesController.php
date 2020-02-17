<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Category;
use App\Difficulty;
use App\CategoryProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Log;

class ProfilesController extends Controller
{
    /**
     * 編集機能
     */
    public function edit($id)
    {
        // GETパラメータが数字かどうかをチェックする
        // 事前にチェックしておくことでDBへの無駄なアクセスが減らせる（WEBサーバーへのアクセスのみで済む）
        if (!ctype_digit($id)) {
            return redirect('/products')->with('flash_message', __('Invalid operation was performed.'));
        }

        $user = User::find($id);
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * 更新機能
     */
    public function update(Request $request, $id)
    {
        Log::debug('プロフィール更新');
        // GETパラメータが数字かどうかをチェックする
        if (!ctype_digit($id)) {
            return redirect('/products/mypage')->with('flash_message', __('Invalid operation was performed.'));
        }
        
        Log::debug('プロフィール更新');
        $user = User::find($id);
        $user->fill($request->all())->save();
        
        $path = $request->pic->store('public/profile_images');
        Log::debug('$request->pic');
        Log::debug($request->pic);
        $user->pic = str_replace('public/', '', $path);
        $user->save();

        return redirect('/products/mypage')->with('flash_message', __('Registered.'));

    }
}
