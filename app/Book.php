<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Media
{

    protected $with = ['author'];

    public function author() {
        return $this->belongsToMany('App\Author');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_book');
    }
}
