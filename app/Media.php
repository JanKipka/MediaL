<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    protected $fillable = [
        'title'
    ];

    public function setTitle($title) {
        $this->attributes['title'] = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function format() {
        return $this->belongsTo('App\Format');
    }

    public function genre() {
        return $this->belongsTo('App\Genre');
    }


}
