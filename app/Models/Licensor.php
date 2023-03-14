<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Licensor
 *
 * @property int $id
 * @property string $name
 * @method static \Database\Factories\LicensorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licensor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
class Licensor extends BaseModel
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
}
