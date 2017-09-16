<?php

namespace App;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $guarded = [];
    // 有效
    const STATUS_VALID = 1;
    // 无效
    const STATUS_INVALID = 0;

}
