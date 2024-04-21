<?php

namespace Pich\Reservations\Test\Unit\Model;

use DateTime;
use OutOfRangeException;
use Pich\Reservations\Model\Api\Data\AvailabilityDay;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use Pich\Reservations\Api\Data\Daily\AvailabilityDayInterface;
use Pich\Reservations\Api\Data\Daily\AvailableDaysIteratorInterface;
use Pich\Reservations\Model\EndDateCalculator;
use PHPUnit\Framework\TestCase;

class EndDateCalculatorTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAllAvailableDays(): void
    {
        $availabilityIterator = $this->createAvailabilityIteratorMock([
            $this->createAvailabilityDay('2023-01-01', 2),
            $this->createAvailabilityDay('2023-01-02', 2),
            $this->createAvailabilityDay('2023-01-03', 2),
            $this->createAvailabilityDay('2023-01-04', 2),
        ]);
        $calculator = new EndDateCalculator();
        $endDate = $calculator->calculateWorkEndDate($availabilityIterator, 8);

        $this->assertEquals(3, $endDate->diff(new DateTime('2023-01-01'))->days);
    }

    /**
     * @throws Exception
     */
    public function testGapInAvailability(): void
    {
        $availabilityIterator = $this->createAvailabilityIteratorMock([
                $this->createAvailabilityDay('2023-01-01', 2),
                $this->createAvailabilityDay('2023-01-03', 2),
                $this->createAvailabilityDay('2023-01-04', 0),
                $this->createAvailabilityDay('2023-01-05', 2),
                $this->createAvailabilityDay('2023-01-06', 2),
        ]);

        $calculator = new EndDateCalculator();
        $endDate = $calculator->calculateWorkEndDate($availabilityIterator, 6);

        $this->assertEquals(4, $endDate->diff(new DateTime('2023-01-01'))->days);
    }

    /**
     * @throws Exception
     */
    public function testOutOfRange(): void
    {
        $this->expectException(OutOfRangeException::class);

        $availabilityIterator = $this->createAvailabilityIteratorMock([
            $this->createAvailabilityDay('2023-01-01', 2),
            $this->createAvailabilityDay('2023-01-03', 2),
            $this->createAvailabilityDay('2023-01-04', 0),
            $this->createAvailabilityDay('2023-01-05', 0),
            $this->createAvailabilityDay('2023-01-06', 0),
        ]);

        $calculator = new EndDateCalculator();
        $calculator->calculateWorkEndDate($availabilityIterator, 6);
    }

    /**
     * @throws Exception,
     */
    private function createAvailabilityDay(string $date, int $hours): AvailabilityDayInterface
    {
        $availabilityDay = new AvailabilityDay();
        $availabilityDay->setDay(new DateTime($date));
        $availabilityDay->setHours($hours);
        return $availabilityDay;
    }

    private function createAvailabilityIteratorMock(array $items): AvailableDaysIteratorInterface|MockObject
    {
        $mockedIterator = $this->createMock(AvailableDaysIteratorInterface::class);
        $iterator = new \ArrayIterator($items);

        $mockedIterator
            ->method('rewind')
            ->willReturnCallback(function () use ($iterator): void {
                $iterator->rewind();
            });

        $mockedIterator
            ->method('current')
            ->willReturnCallback(function () use ($iterator) {
                return $iterator->current();
            });

        $mockedIterator
            ->method('key')
            ->willReturnCallback(function () use ($iterator) {
                return $iterator->key();
            });

        $mockedIterator
            ->method('next')
            ->willReturnCallback(function () use ($iterator): void {
                $iterator->next();
            });

        $mockedIterator
            ->method('valid')
            ->willReturnCallback(function () use ($iterator): bool {
                return $iterator->valid();
            });

        return $mockedIterator;
    }

}
