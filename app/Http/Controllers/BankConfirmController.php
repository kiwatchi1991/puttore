<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class BankConfirmController extends Controller
{
    /**
     * 銀行情報の有無確認（非同期）
     */
    public function ajaxBankConfirm(Request $request)
    {
        Log::debug('ajaxBankCOnfrim');
        $isLogin = !empty(Auth::user());
        $hasBankConfirm = false;

        Log::debug('$isLogin => ' . $isLogin);
        $user = Auth::user();
        if (!empty($user)) {
            Log::debug('$if文の中');
            $hasBankConfirm =
                isset($user->bank_code) &&
                isset($user->bank_branch_code) &&
                isset($user->bank_account_holder_name) &&
                isset($user->bank_account_type) &&
                isset($user->bank_account_number) &&
                isset($user->payjp_tenant_id);
        }

        return response()->json([$isLogin, $hasBankConfirm]);
    }
}
