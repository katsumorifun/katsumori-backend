<?php

namespace App\Models;

use App\Models\Traits\HasTimezone;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Character.
 *
 * @property int $id
 * @property int|null $mal_id
 * @property string $name_jp
 * @property string|null $name_en
 * @property string|null $name_ru
 * @property string $image_x32
 * @property string $image_x64
 * @property string $image_original
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read int|null $staff_count
 * @method static \Database\Factories\CharacterFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereImageOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereImageX32($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereImageX64($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereMalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereNameJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @mixin \Eloquent
 */
class Character extends BaseModel
{
    use HasFactory, HasTimezone;

    protected $fillable = [
        'mal_id',
        'name_jp',
        'name_en',
        'name_ru',
        'image_x32',
        'image_x64',
        'image_original',
    ];
    protected $hidden = ['pivot'];

    public function staff(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'characters_voice_actors');
    }
}
