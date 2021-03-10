<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use \App\Models\Concerns\UsesUuid;

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
        'amount'
    ];

    public function team(){
        return $this->belongsTo('\App\Team');
    }
}
