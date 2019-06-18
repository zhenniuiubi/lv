<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //登录页面
    public function index()
    {
        return view('login.index');
    }

    //登录行为
    public function login()
    {
        //验证
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:5|max:10',
            'is_remember' => 'integer',
        ]);
        $user = request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        if (\Auth::attempt($user, $is_remember)) {
            return view('/posts');
        }
        return \Redirect::back()->withErrors('邮箱密码错误');
    }

    //登出行为
    public function logout()
    {
        return null;
    }
}
