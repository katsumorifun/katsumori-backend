<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genres extends Model
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
