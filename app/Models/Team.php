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
        return $this->hasMany(TeamMember::class);
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
