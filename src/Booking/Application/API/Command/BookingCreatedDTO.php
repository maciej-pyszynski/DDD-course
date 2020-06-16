<?php

declare(strict_types=1);

namespace App\Booking\Application\API\Command;

class BookingCreatedDTO
{
    private string $bookingId;
    private string $redirectUrl;

    public function __construct(
        string $bookingId,
        string $redirectUrl
    ) {
        $this->bookingId = $bookingId;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @return string
     */
    public function getBookingId(): string
    {
        return $this->bookingId;
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }
}
