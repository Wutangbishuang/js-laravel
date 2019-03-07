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
    // 创建文章行为
    public function store()
    {
//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        可以写成下面的方式
        $params = request(['title','content']);
        Post::create($params);
        return redirect('/posts');
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
