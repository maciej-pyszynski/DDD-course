<?php

declare(strict_types=1);

namespace App\Booking\Domain\Service;

use App\Booking\Domain\Factory\BookingFactory;
use App\Booking\Domain\Factory\RoomBookedEventFactory;
use App\Booking\Domain\Port\Repository\BookingRepository;
use App\Booking\Domain\Port\RoomUnitPriceRetriever;
use App\Booking\Domain\Service\Booker\BookingRangeValidator;
use App\Booking\Domain\Service\Booker\BookRoomDTOInterface;
use App\Booking\Domain\Service\Booker\RoomBookedDTO;
use App\Core\Domain\EventBus\Port\EventBus;

class Booker
{
    private RoomBookedEventFactory $roomBookedEventFactory;
    private BookingFactory $bookingFactory;
    private EventBus $eventBus;
    private RoomUnitPriceRetriever $roomUnitPriceRetriever;
    private BookingRepository $bookingRepository;
    private BookingRangeValidator $bookingRangeValidator;

    public function __construct(
        BookingRepository $bookingRepository,
        RoomBookedEventFactory $roomBookedEventFactory,
        BookingFactory $bookingFactory,
        RoomUnitPriceRetriever $roomUnitPriceRetriever,
        EventBus $eventBus,
        BookingRangeValidator $bookingRangeValidator
    ) {
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
     * @param BookRoomDTOInterface $bookRoomDTO
     *
     * @return RoomBookedDTO
     */
    public function book(BookRoomDTOInterface $bookRoomDTO): RoomBookedDTO
    {
        $this->bookingRangeValidator->validate($bookRoomDTO->getBookingRange());

        $unitPrice = $this->roomUnitPriceRetriever->getRoomUnitPrice($bookRoomDTO->getRoomId());
        $booking = $this->bookingFactory->create(
            $bookRoomDTO->getRoomId(),
            $bookRoomDTO->getClientId(),
            $bookRoomDTO->getBookingRange(),
            $unitPrice
        );

        $this->bookingRepository->store($booking);

        $roomBookedEvent = $this->roomBookedEventFactory->createFromBooking($booking);
        $this->eventBus->dispatch($roomBookedEvent);

        return new RoomBookedDTO($booking->getId(), $roomBookedEvent->getRedirectionUrl());
    }
}
