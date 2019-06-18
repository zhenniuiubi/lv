<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    //注册页面
    public function index()
    {
        return view('register.index');
    }

    //注册行为
    public function register()
    {
        //验证
        $this->validate(request(), [
            //unique,users是 数据表 名
            'name' => 'bail|required|min:3|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:10|confirmed',
            'password_confirmation' => 'required|min:5|max:10|same:password',
        ]);

        //逻辑
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));
        $user = User::create(compact('name', 'password', 'email'));
        dd(request()->session()->all());
        // return redirect('/login');
    }
}
