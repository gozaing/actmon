<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * @var Guard
     */
    protected $auth;


    public function __construct(Guard $auth)
    {
        // getLogout メッソド以外は未ログインの場合にのみアクセス出来ます
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->auth = $auth;
    }

    public function postRegister(UserRegisterRequest $request, UserService $user)
    {
        $input = $request->only(['name', 'email', 'password']);
        $result = $user->registerUser($input);
        $this->auth->login($result);

        return redirect()->route('admin.entry.index');
    }

    public function postLogin(LoginRequest $request)
    {
//        $result = $this->auth->attempt(
//            $request->only(['email', 'password']),
//            $request->get('remember', false)
//        );
//        if (!$result) {
//            return redirect()->route('get.login')
//                ->with('message', 'ユーザ認証に失敗しました');
//        }
//
//        return redirect()->route('admin.entry.index');

        $result = $this->auth->attempt(
            $request->only(['email', 'password']),
            $request->get('remember', false)
        );
        if (!$result) {
            return redirect()->route('get.login')
                ->with('message', 'ユーザー認証に失敗しました'); // このメッセージはtransヘルパー関数を利用しても表示できます
        }
        return redirect()->route('admin.entry.index');

    }
}
