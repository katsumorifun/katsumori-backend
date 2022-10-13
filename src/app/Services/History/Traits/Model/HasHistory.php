<?php

namespace App\Services\History\Traits\Model;

use App\Models\History;
use App\Observers\HistoryObserver;

trait HasHistory
{
    static function bootHasHistory()
    {
        static::observe(HistoryObserver::class);
    }

    public function histories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(History::class);
    }
}
