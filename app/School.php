<?php

namespace App;

use PhpParser\Builder;

class School extends Model
{
    protected $table = "schools";

    public function major()
    {
        return $this->hasMany('\App\Major', 'school_id', 'id');
    }

    public function scopeAvailable($query)
    {
        return $query->whereIn('status', [0]);
    }
}
