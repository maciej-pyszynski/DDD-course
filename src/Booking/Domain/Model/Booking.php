<?php

declare(strict_types=1);

namespace App\Booking\Domain\Model;

use App\Booking\Domain\ValueObject\BookingRange;
use App\Core\Domain\ValueObject\BookingId;
use App\Core\Domain\ValueObject\ClientId;
use App\Core\Domain\ValueObject\RoomId;

class Booking
{
    private BookingId $id;
    private RoomId $roomId;
    private ClientId $clientId;
    private BookingRange $bookingRange;

    public function __construct(BookingId $id, RoomId $roomId, ClientId $clientId, BookingRange $bookingRange)
    {
        $this->id = $id;
        $this->roomId = $roomId;
        $this->clientId = $clientId;
        $this->bookingRange = $bookingRange;
    }

    public function getId(): BookingId
    {
        return $this->id;
    }

    public function getRoomId(): RoomId
    {
        return $this->roomId;
    }

    public function setRoomId(RoomId $roomId): void
    {
        $this->roomId = $roomId;
    }

    public function getClientId(): ClientId
    {
        return $this->clientId;
    }

    public function getBookingRange(): BookingRange
    {
        return $this->bookingRange;
    }
}