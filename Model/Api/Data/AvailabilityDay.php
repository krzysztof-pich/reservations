<?php

namespace Pich\Reservations\Model\Api\Data;

use DateTime;
use Pich\Reservations\Api\Data\Daily\AvailabilityDayInterface;

class AvailabilityDay implements AvailabilityDayInterface
{
    private DateTime $day;
    private int $hours;

    public function __construct(DateTime $day, int $hours)
    {
        $this->day = $day;
        $this->hours = $hours;
    }

    public function getDay(): DateTime
    {
        return $this->day;
    }

    public function getHours(): int
    {
        return $this->hours;
    }
}
