<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // 登陆页面
    public function index()
    {
        return view('login.index');
    }

    // 登陆行为
    public function login()
    {

    }

    // 登出行为
    public function logout()
    {
        
    }
}
