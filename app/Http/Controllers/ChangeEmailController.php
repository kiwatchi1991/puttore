<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\EmailReset;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
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
    /**
     * メールアドレスの再設定処理
     *
     * @param Request $request
     * @param [type] $token
     */
    public function reset(Request $request, $token)
    {
        $email_resets = DB::table('email_resets')
            ->where('token', $token)
            ->first();

        // トークンが存在している、かつ、有効期限が切れていないかチェック
        if ($email_resets && !$this->tokenExpired($email_resets->created_at)) {

            // ユーザーのメールアドレスを更新
            $user = User::find($email_resets->user_id);
            $user->email = $email_resets->new_email;
            $user->save();

            // レコードを削除
            DB::table('email_resets')
                ->where('token', $token)
                ->delete();

            return redirect('/mypage')->with('flash_message', 'メールアドレスを更新しました！');
        } else {
            // レコードが存在していた場合削除
            if ($email_resets) {
                DB::table('email_resets')
                    ->where('token', $token)
                    ->delete();
            }
            return redirect('/home')->with('flash_message', 'メールアドレスの更新に失敗しました。');
        }
    }


    /**
     * トークンが有効期限切れかどうかチェック
     *
     * @param  string  $createdAt
     * @return bool
     */
    protected function tokenExpired($createdAt)
    {
        // トークンの有効期限は60分に設定
        $expires = 60 * 60;
        return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
    }
}
