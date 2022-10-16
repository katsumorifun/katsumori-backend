<?php

namespace App\Models;

use App\Services\History\Traits\Model\HasHistory;
use App\Services\Search\Traits\Model\Searchable;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Anime extends Model
{
    use Searchable;
    use HasFactory;
    use HasHistory;

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
    ];

    protected $casts = [
        'title_synonyms' => 'array',
        'episodes_to' => 'datetime',
        'episodes_from' => 'datetime',
    ];

    protected $relations = [
        'studios',
        'licensors',
        'staff',
        'genres',
        'themes',
    ];

    public function studios(): BelongsToMany
    {
        return $this->belongsToMany(Studio::class);
    }

    public function licensors(): BelongsToMany
    {
        return $this->belongsToMany(Licensor::class);
    }

    public function staff(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Theme::class);
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class);
    }

    public function scopeOfStudios(Builder $query, array $studio_ids): Builder
    {
        foreach ($studio_ids as $studio_id) {
            $query->with('studios')->whereHas('studios', function (Builder $query) use ($studio_id) {
                $query->where('id', '=', $studio_id);
            });
        }

        return $query;
    }

    public function scopeOfGenres(Builder $query, array $genre_ids): Builder
    {
        foreach ($genre_ids as $genre_id) {
            $query->with('genres')->whereHas('genres', function (Builder $query) use ($genre_id) {
                $query->where('id', '=', $genre_id);
            });
        }

        return $query;
    }

    public function scopeOfStaff(Builder $query, array $staff_ids): Builder
    {
        foreach ($staff_ids as $staff_id) {
            $query->with('staff')->whereHas('staff', function (Builder $query) use ($staff_id) {
                $query->where('id', '=', $staff_id);
            });
        }

        return $query;
    }
}
