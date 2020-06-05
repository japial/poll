<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['title'];

    public function questions()
    {
    	return $this->hasMany('App\Question');
    }
}
