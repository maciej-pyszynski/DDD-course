<?php

declare(strict_types=1);

namespace App\Booking\Application\Port\Factory;

use App\Booking\Application\Port\Entity\Booking;

interface BookingFactory
{
    public function create(string $id): Booking;
}