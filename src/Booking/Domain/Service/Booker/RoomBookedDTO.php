<?php

declare(strict_types=1);

namespace App\Booking\Domain\Service\Booker;


use App\Core\Domain\ValueObject\BookingId;

class RoomBookedDTO
{
    private BookingId $bookingId;
    private string $redirectUrl;

    public function __construct(BookingId $bookingId, string $redirectUrl)
    {
        $this->bookingId = $bookingId;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @return BookingId
     */
    public function getBookingId(): BookingId
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
