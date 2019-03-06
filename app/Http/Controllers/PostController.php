<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表页面
    public function index()
    {
        return view('post/index');
    }
    // 列表详情
    public function show()
    {
        return view('post/show');
    }
    // 创建文章
    public function create()
    {
        return view('post/create');
    }
    // 创建文章行文
    public function store()
    {

    }
    // 文章编辑
    public function edit()
    {
        return view('post/edit');
    }
    // 文章编辑行为
    public function update()
    {
        
    }
    // 删除文章
    public function delete()
    {
        
    }
}
