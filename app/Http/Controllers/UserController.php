<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // 个人设置页面
    public function setting()
    {
        return view('user.setting');
    }
    
    // 个人设置行为
    public function settingStore()
    {

    }
    
    // 个人中心页面
    public function show()
    {
        return view('user/show');
    }

    // 关注用户
    public function fan()
    {
        
    }

    public function unfan()
    {
        
    }
}
