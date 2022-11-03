<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class AnimeResource extends JsonResource
{
    private bool $producers = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $aired_from = $this->episodes_from ? Carbon::make($this->episodes_from) : null;
        $aired_to = $this->episodes_to ? Carbon::make($this->episodes_to) : null;

        return [
            'id'        => $this->id,
            'mal_id'    => $this->mal_id,
            'images'    => [
                'original' => $this->image_original,
                'x96'      => $this->image_x96,
                'x48'      => $this->image_x48,
                'preview'     => $this->image_preview,
            ],
            'approved'  => $this->approved ? boolval($this->approved) : null,
            'title_jp'  => $this->title_jp,
            'title_en'  => $this->title_en,
            'title_ru'  => $this->title_ru,
            'title_synonyms' => $this->title_synonyms,
            'type'      => $this->type,
            'source'    => $this->source,
            'episodes'  => $this->episodes,
            'status'    => $this->status,
            'airing'    => $this->airing ? boolval($this->airing) : null,
            'aired'     => [
                'from' => $this->episodes_from ? $aired_from->format('Y-m-d H:i:s') : null,
                'to'   => $this->episodes_to ? $aired_to->format('Y-m-d H:i:s') : null,
                'prop' => [
                    'from' => [
                        'day'   =>  $this->episodes_from ? $aired_from->day : null,
                        'month' =>  $this->episodes_from ? $aired_from->month : null,
                        'year'  =>  $this->episodes_from ? $aired_from->year : null,
                    ],
                    'to'  => [
                        'day'   => $this->episodes_to ? $aired_to->day : null,
                        'month' => $this->episodes_to ? $aired_to->month : null,
                        'year'  => $this->episodes_to ? $aired_to->year : null,
                    ],
                ],
            ],
            'duration'   => $this->duration.' min per ep',
            'age_rating'     => $this->age_rating,
            'mal_score'  => round($this->mal_score, 2),
            'score'      => [
                //В будущем будет добавлено, пока рейтинга на сайте нет
            ],
            'statistics' => [
                //В будущем будет добавлено, пока статы на сайте нет
            ],
            'favorites'  => 8392, // В будущем будет добавлено
            'favorite'   => false, //Если тайтл в избранном упользователя, то true, в будущем будет добавлено
            'synopsis'   => [
                'ru' => $this->synopsis_ru,
                'en' => $this->synopsis_en,
            ],
            'season'     => $this->episodes_from ? $this->getSeason($aired_from->monthName) : null,
            'year'       => $this->episodes_from ? $aired_from->year : null,
            'producers'  => $this->when($this->producers, $this->staff),
            'staff'      => $this->when(! $this->producers, $this->staff),
            'licensors'  => $this->licensors,
            'studios'    => $this->studios,
            'genres'     => $this->genres,
            'themes'     => $this->themes,
            'characters' => $this->characters,
        ];
    }

    public static function collection($resource, callable $each = null)
    {
        $collection = new AnonymousResourceCollection($resource, \get_called_class());

        if ($resource && (! $resource instanceof MissingValue) && $each) {
            $collection->resource->each($each);
        }

        return $collection;
    }

    public function getSeason(string $monthName): string
    {
        if ($monthName == 'September' || $monthName == 'October' || $monthName == 'November') {
            return 'autumn';
        }

        if ($monthName == 'December' || $monthName == 'January' || $monthName == 'February') {
            return 'winter';
        }

        if ($monthName == 'June' || $monthName == 'July' || $monthName == 'August') {
            return 'summer';
        }

        return 'spring';
    }

    /**
     * @param  bool  $producers
     */
    public function setProducers(bool $producers): void
    {
        $this->producers = $producers;
    }
}
