<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyEmail extends Model
{
    use HasFactory;

    protected $table = 'verify_emails';

    protected $appends = [
        'hash',
        'user_id'
    ];

    protected $fillable = [
        'hash',
        'user_id',
    ];

    /**
     * Relation one-to-many
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }
}
