<?php

namespace App\Models;

use ALajusticia\AuthTracker\Traits\AuthTracking;
use App\Models\Traits\HasTimezone;
use App\Support\Enums\Group;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $description
 * @property string|null $gender
 * @property int $custom_avatar
 * @property int $group_id
 * @property string $timezone
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Anime> $anime
 * @property-read int|null $anime_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \ALajusticia\AuthTracker\Models\Login> $logins
 * @property-read int|null $logins_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VerifyEmail> $verifyEmil
 * @property-read int|null $verify_emil_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCustomAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withAll()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Anime> $anime
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \ALajusticia\AuthTracker\Models\Login> $logins
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VerifyEmail> $verifyEmil
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Anime> $anime
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \ALajusticia\AuthTracker\Models\Login> $logins
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VerifyEmail> $verifyEmil
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Anime> $anime
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \ALajusticia\AuthTracker\Models\Login> $logins
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VerifyEmail> $verifyEmil
 * @mixin \Eloquent
 */
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
        $this->group_id = $group->value;
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
