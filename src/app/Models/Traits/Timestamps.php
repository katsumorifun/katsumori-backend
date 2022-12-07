<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait Timestamps
{
    protected function formatData(string $data): string
    {
        if (Auth('api')->check()) {
            $data = new Carbon($data);
            $data->timezone(Auth('api')->user()->timezone);

        }

        return $data;
    }

    public function getCreatedAtAttribute(string $data): string
    {
        return $this->formatData($data);
    }

    public function getUpdatedAtAttribute(string $data): string
    {
        return $this->formatData($data);
    }
}
