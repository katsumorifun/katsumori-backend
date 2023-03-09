<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTimeImmutable;
use DateTimeInterface;

trait HasTimezone
{
    protected function getTimeZone(): string
    {
        return optional(auth()->user())->timezone ?? config('app.timezone');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        $date = \Illuminate\Support\Carbon::instance($date);
        $date->setTimezone($this->getTimeZone());

        return $date->format(DATE_ATOM);
    }



//    public function getCreatedAtAttribute(string $data): string
//    {
//        return $this->formatData($data);
//    }
//
//    public function getUpdatedAtAttribute(string $data): string
//    {
//        return $this->formatData($data);
//    }
}
