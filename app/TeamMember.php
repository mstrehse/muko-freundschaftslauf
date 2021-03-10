<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use \App\Models\Concerns\UsesUuid;

    protected $fillable = [
        'team_id',
        'firstname',
        'lastname',
        'gender',
        'yearofbirth'
    ];

    public function team(){
        return $this->belongsTo('\App\Team');
    }
}
