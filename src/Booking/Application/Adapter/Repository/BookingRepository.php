<?php

declare(strict_types=1);

namespace App\Booking\Application\Adapter\Repository;

use App\Booking\Application\Port\Repository\BookingRepository as InfrastructureBookingRepository;
use App\Booking\Application\Transformer\BookingTransformer;
use App\Booking\Domain\Model\Booking as DomainBooking;
use App\Booking\Domain\Port\Repository\BookingRepository as DomainBookingRepository;
use App\Core\Domain\ValueObject\BookingId;

class BookingRepository implements DomainBookingRepository
{
    private InfrastructureBookingRepository $infrastructureBookingRepository;
    private BookingTransformer $bookingTransformer;

    public function __construct(
        BookingTransformer $bookingTransformer,
        InfrastructureBookingRepository $infrastructureBookingRepository
    ) {
        $this->infrastructureBookingRepository = $infrastructureBookingRepository;
        $this->bookingTransformer = $bookingTransformer;
    }

    public function store(DomainBooking $booking): void
    {
        $infrastructureBooking = $this->bookingTransformer->transform($booking);

        $this->infrastructureBookingRepository->store($infrastructureBooking);
    }

    /**
     * TODO: Implement this
     */
    public function get(BookingId $id): DomainBooking
    {
        throw new \Exception('To be implemented');
    }

}