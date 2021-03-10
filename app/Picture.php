<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use \App\Models\Concerns\UsesUuid;

    protected $fillable = [
        'post_id',
        'src'
    ];

    public function post(){
        return $this->belongsTo('\App\Post');
    }
}
