<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Licensor extends BaseModel
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
}
