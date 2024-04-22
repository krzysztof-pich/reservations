<?php

namespace Pich\Reservations\Model\Api;

use Magento\Framework\Stdlib\DateTime;

class DeveloperEstimatedEndOfWork implements \Pich\Reservations\Api\DeveloperEstimatedEndOfWorkInterface
{
    /**
     * @param int $productId
     * @param string $startDate
     * @return string
     */
    public function getEstimatedEndOfWork(int $productId, string $startDate): string
    {
        return '2021-12-31 23:59:59';
    }
}

