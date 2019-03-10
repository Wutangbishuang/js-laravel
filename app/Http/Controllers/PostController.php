<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表页面
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
        return view('post/index' , compact('posts'));
    }
    // 列表详情
    public function show(Post $post)
    {
        $post->load('comments');
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

    // 提交评论
    public function comment(Post $post)
    {
        $this->validate(request(),[
            'content' => 'required|min:3\max:30',
        ]);

        // 逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content= request('content');
        $post->comments()->save($comment);

        // 渲染
        return back();
    }

    // 赞
    public function zan(Post $post)
    {
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        // firstOrCreate -> 如果 有 这个数据就查找出来  如果 没有 就创建
        Zan::firstOrCreate($param);

        return back();
    }

    // 取消赞
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return baclk();
    }

    public function search()
    {
        // 验证
        $this->validate(request(),[
            'query' => 'required'
        ]);
        // 逻辑
        $query = request('query');
        $posts = \App\Post::search($query)->paginate(5);
        // 渲染
        return view("post/search",compact('posts' , 'query'));
    }
}
