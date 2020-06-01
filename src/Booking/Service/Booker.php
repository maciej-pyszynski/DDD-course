<?php

declare(strict_types=1);

namespace App\Booking\Service;

use App\Booking\Entity\Booking;
use App\Booking\Entity\Client;
use App\Room\Entity\Room;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class Booker
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function book(Room $room, Client $client, DateTime $startDate, DateTime $endDate)
    {
        $booking = new Booking();
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setClient($client);
        $booking->setRoom($room);

        $this->entityManager->persist($booking);

        return $booking;
    }
}