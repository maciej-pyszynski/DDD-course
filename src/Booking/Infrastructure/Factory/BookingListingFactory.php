<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\Factory;

use App\Booking\Infrastructure\Entity\BookingListing;

class BookingListingFactory
{
    public function create(string $id): BookingListing
    {
        $bookingListing = new BookingListing();
        $bookingListing->setId($id);

        return $bookingListing;
    }
}