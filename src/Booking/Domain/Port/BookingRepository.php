<?php

namespace App\Booking\Domain\Port;

use App\Booking\Domain\Model\Booking;
use App\Core\Domain\ValueObject\BookingId;

interface BookingRepository
{
    public function store(Booking $booking): void;

    public function get(BookingId $id): Booking;
}