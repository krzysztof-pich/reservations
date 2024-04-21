<?php

namespace Pich\Reservations\Model\Api;

class DeveloperEstimatedEndOfWork implements \Pich\Reservations\Api\DeveloperEstimatedEndOfWorkInterface
{
    public function getEstimatedEndOfWork(int $productId, \DateTime $startDate): \DateTime
    {
        return new \DateTime('2021-12-31 23:59:59');
    }
}

