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
        // 验证
        $this->validate(request(),[
           'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        // 逻辑
//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        可以写成下面的方式
        $user_id = \Auth::id();
        $params = array_merge(request(['title' , 'content']) , compact('user_id'));
        Post::create($params);

        // 渲染
        return redirect('/posts');
    }
    // 文章编辑
    public function edit(Post $post)
    {
        return view('post/edit' , compact('post'));
    }
    // 文章编辑行为
    public function update(Post $post)
    {
        // 验证
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);
        $this->authorize('update' , $post);
        // 逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        // 渲染
        return redirect("/posts/{$post->id}");
    }
    // 删除文章
    public function delete(Post $post)
    {
        $this->authorize('delete' , $post);
        $post->delete();
        return redirect("/posts");
    }

    // 上传图片
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'. $path);
    }
}
