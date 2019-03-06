<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表页面
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(6);
        return view('post/index' , compact('posts'));
    }
    // 列表详情
    public function show(Post $post)
    {
        return view('post/show' , compact('post'));
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
