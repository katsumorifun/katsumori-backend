<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'old_data',
        'new_data',
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
    ];
}
