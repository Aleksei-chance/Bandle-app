<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
