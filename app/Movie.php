<?php

namespace App;

class Movie extends Media
{
    public function directors() {
        return $this->belongsToMany('App\Director');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_movie');
    }
}
