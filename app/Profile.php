<?php


namespace App;


class Profile extends \Illuminate\Database\Eloquent\Model
{

    protected $fillable = [
        'birthday',
        'biography',
        'city',
        'website',
        'twitter'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
