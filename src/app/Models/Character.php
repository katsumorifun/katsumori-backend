<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Character extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'mal_id',
        'name_jp',
        'name_en',
        'name_ru',
        'image_x32',
        'image_x64',
        'image_original',
    ];
    protected $hidden = ['pivot'];

    public function staff(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'characters_voice_actors');
    }
}
