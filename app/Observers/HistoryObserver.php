<?php

namespace App\Observers;

use App\Contracts\History\History;
use App\Support\Facades\Access;

class HistoryObserver
{
    /**
     * Handle the User "deleted" event.
     *
     * @param $model
     * @return void
     */
    public function saved($model): void
    {
        if(auth()->check()) {
            $access = Access::checkPermission(request()->user()->getGroupId(), (new $model)->getTable().'.update');

            if ($access) {
                app(History::class)->add($model, request()->user()->id);
            }
        }
    }
}
