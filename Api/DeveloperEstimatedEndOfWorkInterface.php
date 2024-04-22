<?php

namespace Pich\Reservations\Api;

/**
 * Interface DeveloperEstimatedEndOfWork
 *
 * @api
 */
interface DeveloperEstimatedEndOfWorkInterface
{
    /**
     * @param int $productId
     * @param string $startDate
     * @return string
     */
    public function getEstimatedEndOfWork(int $productId, string $startDate): string;
}
