<?php

namespace App\Traits;

use Carbon\CarbonInterface;
use DateTimeInterface;

trait DefaultDatetimeFormat
{
    /**
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format(CarbonInterface::DEFAULT_TO_STRING_FORMAT);
    }
}
