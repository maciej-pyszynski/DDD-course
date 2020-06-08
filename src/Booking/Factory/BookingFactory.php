<?php

declare(strict_types=1);

namespace App\Booking\Factory;

use App\Booking\Entity\Booking;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

class BookingFactory
{
    private $uuidGenerator;

    /**
     * @return mixed
     */
    public function getUuidGenerator(): UuidFactoryInterface
    {
        if (null === $this->uuidGenerator) {
            $this->uuidGenerator = Uuid::getFactory();
        }

        return $this->uuidGenerator;
    }

    public function create(
        int $roomId,
        int $clientId,
        DateTimeImmutable $startDate,
        DateTimeImmutable $endDate,
        int $price)
    {
        $startDate = $startDate->setTime(0, 0, 0);
        $endDate = $endDate->setTime(0, 0, 0);

        $booking = new Booking($this->getUuidGenerator()->uuid4()->toString());
        $booking->setBookingDate(new DateTimeImmutable());
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setClientId($clientId);
        $booking->setRoomId($roomId);
        $booking->setUnitPrice($price);

        return $booking;
    }
}