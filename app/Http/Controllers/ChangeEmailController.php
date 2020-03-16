<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\EmailReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ChangeEmailController extends Controller
{
    public function index()
    {
        return view('auth.changeEmail');
    }

    public function sendChangeEmailLink(Request $request)
    {
        $new_email = $request->new_email;

        // トークン生成
        $token = hash_hmac(
            'sha256',
            Str::random(40) . $new_email,
            config('app.key')
        );
        // トークンをDBに保存
        DB::beginTransaction();
        try {
            Log::debug('ここまで2');
            $param = [];
            $param['user_id'] = Auth::id();
            $param['new_email'] = $new_email;
            $param['token'] = $token;
            Log::debug('$param');
            Log::debug($param);
            $email_reset = EmailReset::create($param);

            Log::debug('ここまで3');
            DB::commit();
            Log::debug('ここまで4');

            $email_reset->sendEmailResetNotification($token);
            Log::debug('ここまで5');

            return redirect('/mypage')->with('flash_message', '確認メールを送信しました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/mypage')->with('flash_message', 'メール更新に失敗しました。');
        }
    }
}
