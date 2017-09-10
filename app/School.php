<?php

namespace App;

class School extends Model
{
    protected $table = "schools";

    public function major()
    {
        return $this->hasMany('\App\Major', 'school_id', 'id');
    }

    public function getMajorCountAttribute()
    {
        return Major::whereNull('deleted_at')->where('school_id', $this->id)->count();
    }
}
