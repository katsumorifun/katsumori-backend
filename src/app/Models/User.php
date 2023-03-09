<?php

namespace App\Models;

use ALajusticia\AuthTracker\Traits\AuthTracking;
use App\Models\Traits\HasTimezone;
use App\Support\Enums\Group;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, AuthTracking, HasTimezone;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'description',
        'group_id',
        'custom_avatar',
        'timezone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email',
    ];

    const GUEST_GROUP_ID = 1;
    const USER_GROUP_ID = 2;
    const ADMIN_GROUP_ID = 3;
    const ANIME_MODER_GROUP_ID = 4;
    const MANGA_MODER_GROUP_ID = 5;
    const RANOBE_MODER_GROUP_ID = 6;
    const SUPER_MODER_GROUP_ID = 7;
    const USER_MODER_GROUP_ID = 8;
    const STEAMER_GROUP_ID = 9;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation one-to-many.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verifyEmil(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VerifyEmail::class);
    }

    public function getGroupId(): Group
    {
        return Group::from($this->group_id);
    }

    public function setGroup(Group $group)
    {
        return $this->group_id = $group->value;
    }

    public function scopeWithAll(Builder $query)
    {
        $query->with($this->relations);
    }

    public function anime(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class);
    }
}
