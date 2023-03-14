<?php

namespace App\Models;

use App\Models\Traits\HasTimezone;
use App\Services\History\Traits\Model\HasHistory;
use App\Services\Search\Model\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Anime
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $mal_id
 * @property float|null $mal_score
 * @property string $title_jp
 * @property string|null $title_en
 * @property string|null $title_ru
 * @property string|null $synopsis_en
 * @property string|null $synopsis_en_author
 * @property string|null $synopsis_en_author_url
 * @property string|null $synopsis_ru
 * @property string|null $synopsis_ru_author
 * @property string|null $synopsis_ru_author_url
 * @property string|null $type
 * @property int $approved
 * @property string|null $status
 * @property string $image_x96
 * @property string $image_x48
 * @property string $image_preview
 * @property string $image_original
 * @property array|null $title_synonyms
 * @property string|null $source
 * @property int|null $episodes
 * @property int|null $episodes_aired
 * @property \Illuminate\Support\Carbon|null $episodes_from
 * @property \Illuminate\Support\Carbon|null $episodes_to
 * @property int $duration
 * @property string|null $age_rating
 * @property string|null $season
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read int|null $characters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read int|null $histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read int|null $licensors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read int|null $staff_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read int|null $studios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read int|null $themes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\AnimeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Anime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime ofGenres(array $genre_ids)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime ofStaff(array $staff_ids)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime ofStudios(array $studio_ids)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime query()
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereAgeRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodesAired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodesFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereEpisodesTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImageOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImagePreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImageX48($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereImageX96($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereMalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereMalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisEnAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisEnAuthorUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisRuAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereSynopsisRuAuthorUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitleJp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereTitleSynonyms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anime whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withAll()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Genre> $genres
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Licensor> $licensors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Staff> $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Studio> $studios
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Theme> $themes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @mixin \Eloquent
 */
class Anime extends BaseModel
{
    use HasTimezone, Searchable, HasFactory, HasHistory;

    protected $table = 'anime';

    protected $fillable = [
        'mal_id',
        'mal_score',
        'title_jp',
        'title_en',
        'title_ru',
        'synopsis_ru_author_url',
        'synopsis_en_author_url',
        'synopsis_en_author',
        'synopsis_ru_author',
        'synopsis_en',
        'synopsis_ru',
        'type',
        'approved',
        'status',
        'image_x96',
        'image_x48',
        'image_preview',
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
        'episodes_to' => 'date',
        'episodes_from' => 'date',
    ];

    protected $relations = [
        'studios',
        'licensors',
        'staff',
        'genres',
        'themes',
    ];

    public static array $elasticProperties = [
        'title_en' => [
            'type' => 'wildcard',
        ],
        'title_jp' => [
            'type' => 'wildcard',
        ],
        'title_ru' => [
            'type' => 'wildcard',
        ],
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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
