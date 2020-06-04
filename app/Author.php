<?php


namespace App;

class Author extends Person
{
    public function books() {
        $this->belongsToMany('App\Book');
    }
}
