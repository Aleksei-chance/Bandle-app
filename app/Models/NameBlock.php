<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id', 'user_id', 'size', 'link', 'name', 'article', 'pronouns', 'publish', 'hidden'
    ];
}
