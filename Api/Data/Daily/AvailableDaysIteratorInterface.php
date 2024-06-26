<?php

namespace Pich\Reservations\Api\Data\Daily;

use DateTime;
use Iterator;

interface AvailableDaysIteratorInterface extends Iterator
{
    public function __construct(DateTime $startDate);
    public function current(): AvailabilityDayInterface;
}
