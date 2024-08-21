<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'bandle_id', 'user_id', 'block_type_id', 'publish', 'hidden'
    ];

    public function name_content() {
        return $this->hasOne(NameBlock::class, 'block_id')->where('publish', '1')->where('hidden', '0')->first();
    }
}
