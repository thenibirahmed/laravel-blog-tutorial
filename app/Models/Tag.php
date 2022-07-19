<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The post that belong to the Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function post(): BelongsToMany {
        return $this->belongsToMany(Post::class);
    }
}
