<?php

declare(strict_types=1);

namespace App\Booking\Domain\ValueObject;


class BookingRange
{
    private \DateTimeImmutable $startDate;
    private \DateTimeImmutable $endDate;

    public function __construct(\DateTimeImmutable $startDate, \DateTimeImmutable $endDate)
    {
        $this->validate($startDate, $endDate);
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getStartDate(): \DateTimeImmutable
    {
        return $this->startDate;
    }

    public function getEndDate(): \DateTimeImmutable
    {
        return $this->endDate;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validate(\DateTimeImmutable $startDate, \DateTimeImmutable $endDate): void
    {
        if ($startDate > $endDate) {
            throw new \InvalidArgumentException('The end date should be later than start date');
        }

        if ($endDate->diff($startDate)->days > 30) {
            throw new \InvalidArgumentException('Booking range can not exceed 30 days');
        }
    }
}