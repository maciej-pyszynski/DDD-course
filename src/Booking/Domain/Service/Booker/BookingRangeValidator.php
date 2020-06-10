<?php

declare(strict_types=1);

namespace App\Booking\Domain\Service\Booker;

use App\Booking\Domain\Exception\BookingRangeStartDateShouldBeInTheFutureException;
use App\Booking\Domain\ValueObject\BookingRange;

class BookingRangeValidator
{
    /**
     * @throws BookingRangeStartDateShouldBeInTheFutureException
     */
    public function validate(BookingRange $bookingRange)
    {
        if((new \DateTime())->setTime(23, 59, 59) >= $bookingRange->getStartDate()) {
            throw new BookingRangeStartDateShouldBeInTheFutureException();
        }
    }
}