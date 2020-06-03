<?php

declare(strict_types=1);

namespace App\Booking\Service;

use App\Booking\Entity\Booking;
use App\Booking\Exception\BookingException;
use App\Room\Repository\RoomRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class Booker
{
    private EntityManagerInterface $entityManager;
    private float $bookingTax;
    private RoomRepository $roomRepository;

    public function __construct(EntityManagerInterface $entityManager, float $bookingTax, RoomRepository $roomRepository)
    {
        $this->entityManager = $entityManager;
        $this->bookingTax = $bookingTax;
        $this->roomRepository = $roomRepository;
    }

    public function book(int $roomId, int $clientId, DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        $startDate = $startDate->setTime(0, 0, 0);
        $endDate = $endDate->setTime(0, 0, 0);

        $room = $this->roomRepository->find($roomId);

        if (!$room) {
            throw new BookingException('Room not found');
        }

        $booking = new Booking();
        $booking->setBookingDate(new DateTimeImmutable());
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setClientId($clientId);
        $booking->setRoomId($roomId);
        $booking->setUnitPrice($room->getPrice());

        $this->entityManager->persist($booking);

        return $booking;
    }
}
