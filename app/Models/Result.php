<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use UsesUuid;

    protected $fillable = [
        'team_id',
        'name',
        'km',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
