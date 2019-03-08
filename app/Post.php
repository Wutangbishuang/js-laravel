<?php

namespace App;

use App\BaseModel;

class Post extends BaseModel
{
//    protected $guarded; // 不可以注入的字段
//    protected $fillable  // 可以注入的字段

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
}
