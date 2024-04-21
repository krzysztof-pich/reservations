<?php

namespace Pich\Reservations\Api\Data\Daily;

use DateTime;

interface AvailabilityDayInterface
{
    public function setDay(DateTime $day): void;
    public function getDay(): DateTime;
    public function setHours(int $hours): void;
    public function getHours(): int;
}
