<?php

namespace App\Booking\Domain\Service\Booker;

use App\Booking\Domain\ValueObject\BookingRange;
use App\Core\Domain\ValueObject\ClientId;
use App\Core\Domain\ValueObject\RoomId;

interface BookRoomDTOInterface
{
    /**
     * @return RoomId
     */
    public function getRoomId(): RoomId;

    /**
     * @return ClientId
     */
    public function getClientId(): ClientId;

    /**
     * @return BookingRange
     */
    public function getBookingRange(): BookingRange;
}
