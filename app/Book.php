<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Media
{

    protected $with = ['author'];

    protected $fillable = [
        'title',
        'isbn',
        'imageLink',
        'pageCount',
        'publishedDate',
        'textSnippet',
        'format_id',
        'genre_id'
    ];

    public function author() {
        return $this->belongsToMany('App\Author');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_book');
    }
}
