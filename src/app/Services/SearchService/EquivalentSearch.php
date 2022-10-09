<?php

namespace App\Services\SearchService;

use App\Models\Anime;

class EquivalentSearch implements Search
{
    public function anime(string $query)
    {
        return Anime::query()
            ->where('title_en', 'like', "%{$query}%")
            ->orWhere('title_jp', 'like', "%{$query}%")
            ->orWhere('title_ru', 'like', "%{$query}%")
            ->get();
    }
}
