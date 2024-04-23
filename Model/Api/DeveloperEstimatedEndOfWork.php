<?php

namespace Pich\Reservations\Model\Api;

use Pich\Reservations\Api\DeveloperEstimatedEndOfWorkInterface;

class DeveloperEstimatedEndOfWork implements DeveloperEstimatedEndOfWorkInterface
{
    /**
     * @param int $productId
     * @param string $startDate
     * @return string
     */
    public function getEstimatedEndOfWork(int $productId, string $startDate): string
    {
        return '2021-12-31';
    }
}

