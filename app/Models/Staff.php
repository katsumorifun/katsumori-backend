<?php

namespace App\Models;

use App\Models\Traits\HasTimezone;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Staff.
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $mal_id
 * @property string $name_jp
 * @property string|null $name_en
 * @property string|null $name_ru
 * @property string $image_x32
 * @property string $image_x64
 * @property string $image_original
 * @property int $is_voice_actor
 * @property string|null $voice_language
 * @method static \Database\Factories\StaffFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff query()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereImageOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereImageX32($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereImageX64($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereIsVoiceActor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereMalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereNameJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereVoiceLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
class Staff extends BaseModel
{
    use HasFactory, HasTimezone;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'mal_id',
        'name_jp',
        'name_en',
        'name_ru',
        'image_x32',
        'image_x64',
        'image_original',
        'is_voice_actor',
        'voice_language',
    ];
}
