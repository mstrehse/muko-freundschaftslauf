<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use \App\Models\Concerns\UsesUuid;

    protected $fillable = [
        'team_id',
        'name',
        'km'
    ];

    public function team(){
        return $this->belongsTo('\App\Team');
    }
}
