<?php

namespace App;

use App\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;

class Post extends BaseModel
{
//    protected $guarded; // 不可以注入的字段
//    protected $fillable  // 可以注入的字段

    use Searchable;
    // 定义索引里面的type
    public function searchableAs()
    {
        return "post";
    }

    // 定义有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    // 关联用户
    public function user()
    {
        return $this->belongsTo('App\User' , 'user_id' , 'id');
    }
    
    // 评论模型
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    // 赞和用户关联
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    // 文章所有赞
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }

    // 属于某个作者的文章
    public function scopeAuthorBy(\Illuminate\Database\Eloquent\Builder $query,$user_id)
    {
        return $query->where('user_id' , $user_id);
    }

    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class , 'post_id' , 'id');
    }

    // 不属于某个作者的文章
    public function scopeTopicNotBy(Builder $query , $topic_id)
    {
        return $query->doesntHave('postTopics' , 'and' , function($q) use($topic_id) {
            $q->where('topic_id' , $topic_id);
        });
    }
}
