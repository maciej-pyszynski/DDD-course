<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\Adapter\Factory;

use App\Booking\Application\Port\Entity\Booking as BookingInterface;
use App\Booking\Application\Port\Factory\BookingFactory as BookingFactoryInterface;
use App\Booking\Infrastructure\Entity\Booking;

class BookingFactory implements BookingFactoryInterface
{
    public function create(string $id): BookingInterface
    {
        return new Booking($id);
    }
}
