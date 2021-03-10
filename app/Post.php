<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \App\Models\Concerns\UsesUuid;

    protected $fillable = [
        'team_id',
        'text',
        'public'
    ];

    public function team(){
        return $this->belongsTo('\App\Team');
    }

    public function pictures(){
        return $this->hasMany('\App\Picture');
    }
}
