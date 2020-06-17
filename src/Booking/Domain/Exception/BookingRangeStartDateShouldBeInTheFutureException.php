<?php

declare(strict_types=1);

namespace App\Booking\Domain\Exception;

use RuntimeException;

class BookingRangeStartDateShouldBeInTheFutureException extends RuntimeException
{
    protected $message = 'Booking range start date should be in the future';
}