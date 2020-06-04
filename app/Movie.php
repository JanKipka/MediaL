<?php

namespace App;

class Movie extends Media
{
    public function directors() {
        return $this->belongsToMany('App\Director');
    }
}
