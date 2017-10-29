<?php

namespace App;

class Post extends Model
{
    protected $table = "posts";
    protected $appends = ['short_content'];

    public function comments()
    {
        return $this->hasMany('\App\ShuoshuoComment', 'shuoshuo_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

    public function forum()
    {
        return $this->hasOne('\App\Forum', 'id', 'forum_id');
    }

    public function getShortContentAttribute()
    {
        return getShareContent($this->attributes['content']);
    }
}
