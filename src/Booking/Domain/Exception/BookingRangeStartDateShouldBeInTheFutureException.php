<?php

declare(strict_types=1);

namespace App\Booking\Domain\Exception;

use RuntimeException;

class BookingRangeStartDateShouldBeInTheFutureException extends RuntimeException
{

}