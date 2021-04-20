<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use UsesUuid;

    protected $fillable = [
        'post_id',
        'src',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
