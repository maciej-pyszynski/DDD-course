<?php

declare(strict_types=1);

namespace App\Booking\Domain\Service\Booker;

use App\Booking\Domain\ValueObject\BookingRange;
use App\Core\Domain\ValueObject\ClientId;
use App\Core\Domain\ValueObject\RoomId;

class BookRoomDTO implements BookRoomDTOInterface
{
    private RoomId $roomId;
    private ClientId $clientId;
    private BookingRange $bookingRange;

    /**
     * @param RoomId       $roomId
     * @param ClientId     $clientId
     * @param BookingRange $bookingRange
     */
    public function __construct(RoomId $roomId, ClientId $clientId, BookingRange $bookingRange)
    {
        $this->roomId = $roomId;
        $this->clientId = $clientId;
        $this->bookingRange = $bookingRange;
    }

    /**
     * @return RoomId
     */
    public function getRoomId(): RoomId
    {
        return $this->roomId;
    }

    /**
     * @return ClientId
     */
    public function getClientId(): ClientId
    {
        return $this->clientId;
    }

    /**
     * @return BookingRange
     */
    public function getBookingRange(): BookingRange
    {
        return $this->bookingRange;
    }
}
