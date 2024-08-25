<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id', 'user_id', 'icon', 'link', 'sort', 'publish', 'hidden'
    ];
}
