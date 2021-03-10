<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use \App\Models\Concerns\UsesUuid;

    protected $fillable = [
        'name',
        'gender',
        'firstname',
        'lastname',
        'street',
        'city',
        'country',
        'email',
        'phone',
        'yearofbirth'
    ];

    public function members() {
        return $this->hasMany('\App\TeamMember');
    }

    public function sponsors(){
        return $this->hasMany('\App\Sponsor');
    }

    public function results(){
        return $this->hasMany('\App\Result');
    }

    public function posts(){
        return $this->hasMany('\App\Post');
    }
}
