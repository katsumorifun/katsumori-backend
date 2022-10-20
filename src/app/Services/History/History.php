<?php

namespace App\Services\History;

use App\Contracts\History\History as HistoryContract;
use App\Models\History as HistoryModel;
use Illuminate\Database\Eloquent\Model;

class History implements HistoryContract
{
    public function add(Model $model, bool $moderate = false)
    {
        $diff = array_diff($model->getRawOriginal(), $model->getAttributes());

        if (! empty($diff)) {
            $history = new HistoryModel();

            $history->fill([
                'old_data' => $model->getOriginal(),
                'new_data' => $model->attributesToArray(),
                'type' => $moderate ? 'moderation' : 'history',
            ]);

            $history->save();

            $model->histories()->attach($history);

        }
    }
}
