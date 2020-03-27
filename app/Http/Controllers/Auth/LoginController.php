<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request; //api用に追加

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // ここから
        if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $path = parse_url($_SERVER['HTTP_REFERER']); // URLを分解
            if (array_key_exists('HOST', $path)) {
                if ($path['HOST'] == $_SERVER['HTTP_HOST']) { // ホスト部分が自ホストと同じ
                    session(['url.intended' => $_SERVER['HTTP_REFERER']]);
                }
            }
        }
        // ここまで追加
        return view('auth.login');
    }

    protected function redirectTo()
    {
        redirect('/products')->with('flash_message', 'ログインしました');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('/')->with('flash_message', 'ログアウトしました');
    }
}
