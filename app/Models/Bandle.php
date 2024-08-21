<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class bandle extends Model
{
    use HasFactory;

    protected $table = 'bandles';

    protected $fillable = [
        'user_id', 'title', 'description', 'publish', 'hidden'
    ];

    protected $casts = [
        'user_id' => 'integer'
        , 'publish' => 'boolean'
        , 'hidden' => 'boolean'
    ];

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'bandle_id')->where('publish', '1')->where('hidden', '0');
    }

    public function blocks_count()
    {
        return $this->hasMany(Block::class, 'bandle_id')->where('publish', '1')->where('hidden', '0')->count();
    }
}
