<?php

declare(strict_types=1);

namespace App\Booking\Service;

use App\Booking\Entity\Booking;
use App\Room\Api\Exception\RoomNotFoundException;
use App\Room\Api\Query\DTO\RoomPriceDTO;
use App\Room\Api\Query\RoomPriceQuery;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Booker
{
    use HandleTrait;

    private EntityManagerInterface $entityManager;
    private float $bookingTax;

    public function __construct(EntityManagerInterface $entityManager, float $bookingTax, MessageBusInterface $messageBus)
    {
        $this->entityManager = $entityManager;
        $this->bookingTax = $bookingTax;
        $this->messageBus = $messageBus;
    }

    /**
     * @throws RoomNotFoundException
     */
    public function book(int $roomId, int $clientId, DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        $startDate = $startDate->setTime(0, 0, 0);
        $endDate = $endDate->setTime(0, 0, 0);

        $roomPriceDTO = $this->getRoomPrice($roomId);

        $booking = new Booking();
        $booking->setBookingDate(new DateTimeImmutable());
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setClientId($clientId);
        $booking->setRoomId($roomId);
        $booking->setUnitPrice($roomPriceDTO->getPrice());

        $this->entityManager->persist($booking);

        return $booking;
    }

    /**
     * @throws RoomNotFoundException
     */
    private function getRoomPrice(int $roomId): RoomPriceDTO
    {
        $result = $this->handle(new RoomPriceQuery($roomId));

        if ($result instanceof Exception) {
            throw $result;
        }

        return $result;
    }
}
