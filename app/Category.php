<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = ['id'];

    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }
}
