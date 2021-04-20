<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use UsesUuid;

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
        'yearofbirth',
    ];

    public function members()
    {
        return $this->hasMany('\App\TeamMember');
    }

    public function sponsors()
    {
        return $this->hasMany('\App\Sponsor');
    }

    public function results()
    {
        return $this->hasMany('\App\Result');
    }

    public function posts()
    {
        return $this->hasMany('\App\Models\Post');
    }
}
