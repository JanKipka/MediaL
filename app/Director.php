<?php

namespace App;

class Director extends Person
{
    public function movies() {
        return $this->belongsToMany('App\Movie');
    }
}
