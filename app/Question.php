<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function options()
    {
        return $this->hasMany('App\Option');
    }

    public function answer(){
        return $this->hasOne('App\Answer');
    }
}
