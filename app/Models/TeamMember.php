<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use UsesUuid;

    protected $fillable = [
        'team_id',
        'firstname',
        'lastname',
        'gender',
        'yearofbirth',
    ];

    public function team()
    {
        return $this->belongsTo('\App\Team');
    }
}
