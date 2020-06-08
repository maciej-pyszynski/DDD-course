<?php

declare(strict_types=1);

namespace App\Booking\Factory;

use App\Booking\Entity\Booking;
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
            $booking->getId(),
            $booking->getRoomId(),
            $booking->getClientId(),
            $booking->getStartDate(),
            $booking->getEndDate(),
            $this->defaultRedirectUrl
        );
    }
}