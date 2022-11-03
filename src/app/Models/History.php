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
        'moderator_id',
        'rejected',
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
        'reject'   => 'boolean',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id')
            ->select(['id', 'name', 'created_at', 'updated_at', 'gender']);
    }

    public function moderator(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'moderator_id')
            ->select(['id', 'name', 'created_at', 'updated_at', 'gender']);
    }
}
