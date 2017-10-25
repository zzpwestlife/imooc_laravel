<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use SoftDeletes;
    public $timestamps = true;

    protected $table = "forums";

}
