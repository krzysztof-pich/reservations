<?php

namespace Pich\Reservations\Api\Data\Daily;

use DateTime;

interface AvailabilityDayInterface
{
    public function getDay(): DateTime;
    public function getHours(): int;
}
