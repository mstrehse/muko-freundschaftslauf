<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use UsesUuid;

    protected $fillable = [
        'team_id',
        'text',
        'public',
    ];

    public function team()
    {
        return $this->belongsTo('\App\Team');
    }

    public function pictures()
    {
        return $this->hasMany('\App\Models\Picture');
    }
}
