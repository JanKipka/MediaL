<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['firstName', 'lastName'];

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->attributes['firstName'] = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->attributes['lastName'] = $lastName;
    }
}
