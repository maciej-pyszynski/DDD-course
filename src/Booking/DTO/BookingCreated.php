<?php

declare(strict_types=1);

namespace App\Booking\DTO;

use App\Booking\Entity\Booking;

class BookingCreated
{
    private Booking $booking;
    private string $redirectUrl;

    /**
     * BookingCreated constructor.
     * @param Booking $booking
     * @param string $redirectUrl
     */
    public function __construct(Booking $booking, string $redirectUrl)
    {
        $this->booking = $booking;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @return Booking
     */
    public function getBooking(): Booking
    {
        return $this->booking;
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }
}