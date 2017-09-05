<?php

namespace App;

class School extends Model
{
    protected $table = "schools";

    public function major()
    {
        return $this->hasMany('\App\Major', 'school_id', 'id');
    }
//
//    public function user()
//    {
//        return $this->belongsTo('\App\User', 'user_id', 'id');
//    }
}
