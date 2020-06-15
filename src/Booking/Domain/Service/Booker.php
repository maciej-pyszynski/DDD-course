<?php

declare(strict_types=1);

namespace App\Booking\Domain\Service;

use App\Booking\Domain\Exception\BookingRangeStartDateShouldBeInTheFutureException;
use App\Booking\Domain\Factory\BookingFactory;
use App\Booking\Domain\Port\Repository\BookingRepository;
use App\Booking\Domain\Port\RoomUnitPriceRetriever;
use App\Booking\Domain\Service\Booker\BookingRangeValidator;
use App\Booking\Domain\Service\Booker\RoomBookedDTO;
use App\Booking\Domain\ValueObject\BookingRange;
use App\Booking\Domain\Factory\RoomBookedEventFactory;
use App\Core\Domain\EventBus\Port\EventBus;
use App\Core\Domain\ValueObject\ClientId;
use App\Core\Domain\ValueObject\RoomId;

class Booker
{
    private float $bookingTax;
    private RoomBookedEventFactory $roomBookedEventFactory;
    private BookingFactory $bookingFactory;
    private EventBus $eventBus;
    private RoomUnitPriceRetriever $roomUnitPriceRetriever;
    private BookingRepository $bookingRepository;
    private BookingRangeValidator $bookingRangeValidator;

    public function __construct(
        float $bookingTax,
        BookingRepository $bookingRepository,
        RoomBookedEventFactory $roomBookedEventFactory,
        BookingFactory $bookingFactory,
        RoomUnitPriceRetriever $roomUnitPriceRetriever,
        EventBus $eventBus,
        BookingRangeValidator $bookingRangeValidator
    ) {
        $this->bookingTax = $bookingTax;
        $this->roomBookedEventFactory = $roomBookedEventFactory;
        $this->bookingFactory = $bookingFactory;
        $this->eventBus = $eventBus;
        $this->roomUnitPriceRetriever = $roomUnitPriceRetriever;
        $this->bookingRepository = $bookingRepository;
        $this->bookingRangeValidator = $bookingRangeValidator;
    }

    /**
     * Warning: Usage of this method should be wrapped in DB transaction
     *
     * @throws BookingRangeStartDateShouldBeInTheFutureException
     */
    public function book(RoomId $roomId, ClientId $clientId, BookingRange $bookingRange): RoomBookedDTO
    {
        $this->bookingRangeValidator->validate($bookingRange);

        $unitPrice = $this->roomUnitPriceRetriever->getRoomUnitPrice($roomId);
        $booking = $this->bookingFactory->create($roomId, $clientId, $bookingRange, $unitPrice);

        $this->bookingRepository->store($booking);

        $roomBookedEvent = $this->roomBookedEventFactory->createFromBooking($booking);
        $this->eventBus->dispatch($roomBookedEvent);

        return new RoomBookedDTO($booking->getId(), $roomBookedEvent->getRedirectionUrl());
    }
}
