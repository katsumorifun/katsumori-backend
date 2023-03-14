<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Studio
 *
 * @property int $id
 * @property string $name
 * @method static \Database\Factories\StudioFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Studio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Studio whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @mixin \Eloquent
 */
class Studio extends BaseModel
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public $timestamps = false;
    protected $fillable = ['name'];
}
