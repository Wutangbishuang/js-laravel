<?php

namespace App\Admin\Controllers;

class LoginController extends Controller
{
    // 登陆展示页
    public function index()
    {
        return view('admin.login.index');
    }

    // 登陆操作
    public function login()
    {
        // 验证
        $this->validate(request() , [
            'name' => 'required|min:2',
            'password' => 'required|min:5|max:16',
        ]);
        // 逻辑
        $user = request(['name' , 'password']);
        if(\Auth::guard("admin")->attempt($user)) {
            return redirect('/admin/home');
        }
        // 渲染
        return \Redirect::back()->withErrors('用户密码不匹配');
    }
    // 登出
    public function logout()
    {
        \Auth::guard("admin")->logout();
        return redirect('/admin/login');
    }
}