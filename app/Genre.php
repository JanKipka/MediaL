<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name'
    ];

    public function setName($name) {
        $this->attributes['name'] = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function media() {
        return $this->hasMany('App\Media');
    }
}
