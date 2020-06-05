<?php


namespace App;

class Author extends Person
{
    public function books() {
        return $this->belongsToMany('App\Book');
    }
}
