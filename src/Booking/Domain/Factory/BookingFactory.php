<?php

declare(strict_types=1);

namespace App\Booking\Domain\Factory;

use App\Booking\Domain\Model\Booking;
use App\Booking\Domain\ValueObject\BookingRange;
use App\Booking\Service\BookingIdGenerator;
use App\Core\Domain\ValueObject\BookingId;
use App\Core\Domain\ValueObject\ClientId;
use App\Core\Domain\ValueObject\RoomId;

class BookingFactory
{
    private BookingIdGenerator $bookingIdGenerator;

    public function __construct(BookingIdGenerator $bookingIdGenerator)
    {
        $this->bookingIdGenerator = $bookingIdGenerator;
    }

    public function create(RoomId $roomId, ClientId $clientId, BookingRange $bookingRange): Booking
    {
        return new Booking(
            new BookingId($this->bookingIdGenerator->generate()),
            $roomId,
            $clientId,
            $bookingRange
        );
    }
}