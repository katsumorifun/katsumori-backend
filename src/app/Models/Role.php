<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];
    protected $appends = ['permissions'];
    public $timestamps = false;

    protected $fillable = [
        'en_name',
        'russian_name',
        'id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection permissions this user
     */
    public function getPermissionsAttribute(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->permissions()->get();
    }
}
