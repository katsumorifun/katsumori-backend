<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Theme
 *
 * @property int $id
 * @property string $name_jp
 * @property string|null $name_en
 * @property string|null $name_ru
 * @method static \Database\Factories\ThemeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Theme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme query()
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereNameJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Theme whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
class Theme extends BaseModel
{
    use HasFactory;

    protected $hidden = ['pivot'];
    public $timestamps = false;

    protected $fillable = [
        'name_en',
        'name_jp',
        'name_ru',
    ];
}
