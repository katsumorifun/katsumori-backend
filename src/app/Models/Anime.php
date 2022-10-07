<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Anime extends Model
{
    use HasFactory;

    protected $table = 'anime';

    protected $fillable = [
        'mal_id',
        'mal_score',
        'title_jp',
        'title_en',
        'title_ru',
        'synopsis_en',
        'synopsis_ru',
        'type',
        'approved',
        'status',
        'image_x32',
        'image_x64',
        'image_x128',
        'image_original',
        'title_synonyms',
        'source',
        'episodes',
        'episodes_aired',
        'episodes_to',
        'episodes_from',
        'duration',
        'age_rating',
        'season',
        'year',
    ];

    public function studios(): BelongsToMany
    {
        return $this->belongsToMany(Studios::class);
    }

    public function licensors(): BelongsToMany
    {
        return $this->belongsToMany(Licensors::class);
    }

    public function staff(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genres::class);
    }
    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Themes::class);
    }

}
