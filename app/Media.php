<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    protected $fillable = [
        'title',
        'format',
    ];

    public function setTitle($title) {
        $this->attributes['title'] = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setFormat($format) {
        $this->attributes['format'] = $format;
    }

    public function getFormat() {
        return $this->format;
    }

    public function genre() {
        return $this->belongsTo('App\Genre');
    }

}
