<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\Adapter\Repository;

use App\Booking\Application\Port\Entity\Booking;
use App\Booking\Application\Port\Repository\BookingRepository as BookingRepositoryInterface;
use App\Booking\Infrastructure\Repository\BookingRepository as InfrastructureBookingRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookingRepository implements BookingRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private InfrastructureBookingRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, InfrastructureBookingRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function store(Booking $booking)
    {
        $this->entityManager->persist($booking);
    }

    public function getById(string $id): ?Booking
    {
        return $this->repository->find($id);
    }
}
