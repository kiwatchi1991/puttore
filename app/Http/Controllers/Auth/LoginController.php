<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
        if (isset($_SERVER['HTTP_REFERER'])) {
            $intended = $_SERVER['HTTP_REFERER'];
        } else {
            $intended = '/';
        }
        session(['url.intended' => $intended]);
        // ここまで追加
        return view('auth.login');
    }

    protected function authenticated()
    {
        $intended = session('url.intended');
        if (parse_url($intended, PHP_URL_PATH) == '/') {
            $id = Auth::user()->id;
            return redirect()->route('profile.show', $id)->with('flash_message', 'ログインしました');
        } else {
            return redirect($intended)->with('flash_message', 'ログインしました');
        }
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
