<?php

namespace App\Services\History;

use App\Contracts\History\History as HistoryContract;
use Illuminate\Database\Eloquent\Model;
use App\Models\History as HistoryModel;

class History implements HistoryContract
{
    public function add(Model $model)
    {
        if ($model->wasChanged()) {
            $history = new HistoryModel();

            $history->fill([
                'old_data' => $model->getOriginal(),
                'new_data' => $model->attributesToArray(),
            ]);

            $history->save();

            $model->histories()->attach($history);
        }
    }
}
