<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use UsesUuid;

    protected $fillable = [
        'team_id',
        'name',
        'contact',
        'street',
        'city',
        'number',
        'email',
        'phone',
        'infos',
        'amount',
    ];

    public function team()
    {
        return $this->belongsTo('\App\Team');
    }
}
