<?php

declare(strict_types=1);

namespace App\Booking\Domain\ValueObject;

use DateTimeImmutable;

class BookingDate
{
    private DateTimeImmutable $bookingDate;

    public function __construct(DateTimeImmutable $bookingDate)
    {
        $this->validate($bookingDate);

        $this->bookingDate = $bookingDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getValue(): DateTimeImmutable
    {
        return $this->bookingDate;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validate(DateTimeImmutable $bookingDate): void
    {
        if ($bookingDate > (new DateTimeImmutable('+1 second'))) {
            throw new \InvalidArgumentException('The booking date cannot be in the future.');
        }
    }
}
