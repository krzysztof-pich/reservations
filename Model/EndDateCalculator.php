<?php

namespace Pich\Reservations\Model;

use DateTime;
use Pich\Reservations\Api\Data\Daily\AvailableDaysIteratorInterface;

class EndDateCalculator
{



    public function calculateWorkEndDate(AvailableDaysIteratorInterface $availableDays, int $horusBought): DateTime
    {
        foreach ($availableDays as $item) {
            $horusBought -= $item->getHours();
            if ($horusBought <= 0) {
                return $item->getDay();
            }
        }
        throw new \OutOfRangeException('End date not found');
    }
}
