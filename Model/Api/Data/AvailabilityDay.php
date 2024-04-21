<?php

namespace Pich\Reservations\Model\Api\Data;

use DateTime;
use Pich\Reservations\Api\Data\Daily\AvailabilityDayInterface;

class AvailabilityDay implements AvailabilityDayInterface
{
    private DateTime $day;
    private int $hours;

    public function setDay(DateTime $day): void
    {
        $this->day = $day;
    }

    public function getDay(): DateTime
    {
        return $this->day;
    }

    public function setHours(int $hours): void
    {
        $this->hours = $hours;
    }

    public function getHours(): int
    {
        return $this->hours;
    }
}
