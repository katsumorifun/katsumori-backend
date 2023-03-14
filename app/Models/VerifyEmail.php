<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\VerifyEmail
 *
 * @property int $id
 * @property int $user_id
 * @property string $hash
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerifyEmail whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @mixin \Eloquent
 */
class VerifyEmail extends BaseModel
{
    use HasFactory;

    protected $table = 'verify_emails';

    protected $appends = [
        'hash',
        'user_id',
    ];

    protected $fillable = [
        'hash',
        'user_id',
    ];

    /**
     * Relation one-to-many.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }
}
