<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $guarded = [];

    public function question(){
        $this->belongsTo('App\Question');
    }
}
