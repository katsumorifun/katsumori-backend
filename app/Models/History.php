<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\History.
 *
 * @property int $id
 * @property array $old_data
 * @property array $new_data
 * @property string $type
 * @property int $user_id
 * @property int $rejected
 * @property int|null $moderator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $moderator
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History query()
 * @method static \Illuminate\Database\Eloquent\Builder|History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereModeratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereNewData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereOldData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
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
