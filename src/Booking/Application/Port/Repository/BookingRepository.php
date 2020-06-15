<?php

declare(strict_types=1);

namespace App\Booking\Application\Port\Repository;

use App\Booking\Application\Port\Entity\Booking;

interface BookingRepository
{
    public function store(Booking $booking);

    public function getById(string $id): ?Booking;
}