<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Genre.
 *
 * @property int $id
 * @property string $name_jp
 * @property string $name_en
 * @property string $name_ru
 * @method static \Database\Factories\GenreFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereNameJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
class Genre extends BaseModel
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
