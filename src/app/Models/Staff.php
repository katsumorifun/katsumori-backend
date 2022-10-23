<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends BaseModel
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'mal_id',
        'name_jp',
        'name_en',
        'name_ru',
        'image_x32',
        'image_x64',
        'image_original',
        'is_voice_actor',
        'voice_language',
    ];
}
