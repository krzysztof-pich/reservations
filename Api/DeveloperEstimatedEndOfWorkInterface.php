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
     * @param \DateTime $startDate
     * @return \DateTime
     */
    public function getEstimatedEndOfWork(int $productId, \DateTime $startDate): \DateTime;
}
