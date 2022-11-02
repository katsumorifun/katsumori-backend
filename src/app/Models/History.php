<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends BaseModel
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'old_data',
        'new_data',
        'type',
        'user_id',
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id');
    }
}
