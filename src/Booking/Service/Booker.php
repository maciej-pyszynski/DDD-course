<?php

declare(strict_types=1);

namespace App\Booking\Service;

use App\Booking\Entity\Booking;
use App\Booking\Entity\Client;
use App\Room\Entity\Room;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class Booker
{
    private EntityManagerInterface $entityManager;
    private float $bookingTax;

    public function __construct(EntityManagerInterface $entityManager, float $bookingTax)
    {
        $this->entityManager = $entityManager;
        $this->bookingTax = $bookingTax;
    }

    public function book(Room $room, Client $client, DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        $startDate = $startDate->setTime(0, 0, 0);
        $endDate = $endDate->setTime(0, 0, 0);
        $datesDiffInterval = $endDate->diff($startDate);
        $daysDiff = $datesDiffInterval->d;

        $bookingNetPrice = $daysDiff * $room->getPrice();
        $bookingGrossPrice = (int)round($bookingNetPrice * (1+$this->bookingTax));


        $booking = new Booking();
        $booking->setBookingDate(new DateTimeImmutable());
        $booking->setStartDate($startDate);
        $booking->setEndDate($endDate);
        $booking->setClient($client);
        $booking->setRoom($room);
        $booking->setPrice($room->getPrice());
        $booking->setQuantity($daysDiff);
        $booking->setTaxPercentage($this->bookingTax);
        $booking->setTotal($bookingGrossPrice);

        $this->entityManager->persist($booking);

        return $booking;
    }
}