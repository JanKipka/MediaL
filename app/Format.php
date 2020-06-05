<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $fillable = ['name' , 'mediaFormat'];

    public function media() {
        return $this->hasMany('App\Media');
    }

}
