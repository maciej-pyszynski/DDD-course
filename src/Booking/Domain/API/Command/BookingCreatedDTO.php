<?php

namespace App\Booking\Domain\API\Command;

use App\Core\Domain\ValueObject\BookingId;

interface BookingCreatedDTO
{
    /**
     * @return BookingId
     */
    public function getBookingId(): BookingId;

    /**
     * @return string
     */
    public function getRedirectUrl(): string;
}
