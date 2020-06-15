<?php

declare(strict_types=1);

namespace App\Booking\Application\Transformer;

use App\Booking\Application\Mapper\BookingMapper;
use App\Booking\Application\Port\Entity\Booking as InfrastructureBooking;
use App\Booking\Application\Port\Factory\BookingFactory;
use App\Booking\Application\Port\Repository\BookingRepository;
use App\Booking\Domain\Model\Booking as DomainBooking;

class BookingTransformer
{
    private BookingRepository $bookingRepository;
    private BookingFactory $bookingFactory;
    private BookingMapper $bookingMapper;

    public function __construct(BookingRepository $bookingRepository, BookingFactory $bookingFactory, BookingMapper $bookingMapper)
    {
        $this->bookingRepository = $bookingRepository;
        $this->bookingFactory = $bookingFactory;
        $this->bookingMapper = $bookingMapper;
    }

    public function transform(DomainBooking $booking): InfrastructureBooking
    {
        $id = $booking->getId()->getValue();
        $infrastructureBooking = $this->bookingRepository->getById($id);

        if (null === $infrastructureBooking) {
            $infrastructureBooking = $this->bookingFactory->create($id);
        }

        $this->bookingMapper->mapFromDomainToInfrastructure($booking, $infrastructureBooking);

        return $infrastructureBooking;
    }

    /**
     * TODO: Implement this
     */
    public function reverseTransform(InfrastructureBooking $infrastructureBooking): DomainBooking
    {
        throw new \Exception('To be implemented');
    }
}