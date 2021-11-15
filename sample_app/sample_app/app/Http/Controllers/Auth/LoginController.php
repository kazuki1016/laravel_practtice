<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//Requestメソッドを使用可能にする
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

    // use AuthenticatesUsers;
    use AuthenticatesUsers{
        //logout というメソッドを、doLogoutというメソッド名に変更して継承する
        logout as doLogout;
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/messages';    //ログイン後のリダイレクト先を/messagesへ変更

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //ログアウトするメソッド
    public function logout(Request $request){
        // 1. 元々のログアウト処理を実行する
        $this->doLogout($request);
        // 2. リダイレクト先を独自に設定する。
        return redirect('/login');
    }
}
