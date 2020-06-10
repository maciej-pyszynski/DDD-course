<?php

declare(strict_types=1);

namespace App\Booking\Domain\Factory;

use App\Booking\Domain\Model\Booking;
use App\Core\Domain\Event\RoomBooked;

class RoomBookedEventFactory
{
    private $defaultRedirectUrl;

    /**
     * RoomBookedEventFactory constructor.
     * @param $defaultRedirectUrl
     */
    public function __construct($defaultRedirectUrl)
    {
        $this->defaultRedirectUrl = $defaultRedirectUrl;
    }

    public function createFromBooking(Booking $booking)
    {
        return new RoomBooked(
            $booking->getId()->getValue(),
            $booking->getRoomId()->getValue(),
            $booking->getClientId()->getValue(),
            $booking->getBookingRange()->getStartDate(),
            $booking->getBookingRange()->getEndDate(),
            $this->defaultRedirectUrl
        );
    }
}