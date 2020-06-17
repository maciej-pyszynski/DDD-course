<?php

declare(strict_types=1);

namespace App\Booking\Domain\Factory;

use App\Booking\Domain\Model\Booking;
use App\Booking\Domain\Port\IdGenerator;
use App\Booking\Domain\ValueObject\BookingDate;
use App\Booking\Domain\ValueObject\BookingRange;
use App\Core\Infrastructure\UuidGenerator\Adapter\UuidGenerator;
use App\Core\Domain\ValueObject\BookingId;
use App\Core\Domain\ValueObject\ClientId;
use App\Core\Domain\ValueObject\Money;
use App\Core\Domain\ValueObject\RoomId;
use DateTimeImmutable;

class BookingFactory
{
    private IdGenerator $bookingIdGenerator;

    public function __construct(IdGenerator $bookingIdGenerator)
    {
        $this->bookingIdGenerator = $bookingIdGenerator;
    }

    public function create(RoomId $roomId, ClientId $clientId, BookingRange $bookingRange, ?Money $unitPrice): Booking
    {
        return new Booking(
            new BookingId($this->bookingIdGenerator->generate()),
            new BookingDate(new DateTimeImmutable()),
            $roomId,
            $clientId,
            $bookingRange,
            $unitPrice
        );
    }
}
