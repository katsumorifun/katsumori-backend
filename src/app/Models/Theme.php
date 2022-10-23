<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends BaseModel
{
    use HasFactory;

    protected $hidden = ['pivot'];
    public $timestamps = false;

    protected $fillable = [
        'name_en',
        'name_jp',
        'name_ru',
    ];
}
