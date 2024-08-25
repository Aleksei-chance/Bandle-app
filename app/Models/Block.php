<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'bandle_id', 'user_id', 'sort', 'block_type_id', 'publish', 'hidden'
    ];

    public function name_content() {
        return $this->hasOne(NameBlock::class, 'block_id')->where('publish', '1')->where('hidden', '0')->first();
    }

    public function social_links() {
        return $this->hasMany(SocialLink::class, 'block_id')->where('publish', '1')->where('hidden', '0');
    }

    public function social_links_count() {
        return $this->hasMany(SocialLink::class, 'block_id')->where('publish', '1')->where('hidden', '0')->count();
    }
}
