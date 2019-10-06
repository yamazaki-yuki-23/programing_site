<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function goods()
    {
        return $this->hasMany('App\Good');
    }
}
