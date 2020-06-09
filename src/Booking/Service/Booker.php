<?php

declare(strict_types=1);

namespace App\Booking\Service;

use App\Booking\DTO\BookingCreated;
use App\Booking\Entity\Booking;
use App\Booking\Factory\BookingFactory;
use App\Booking\Factory\RoomBookedEventFactory;
use App\Core\Domain\Event\RoomBooked;
use App\Room\Api\Exception\RoomNotFoundException;
use App\Room\Api\Query\DTO\RoomPriceDTO;
use App\Room\Api\Query\RoomPriceQuery;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Booker
{
    use HandleTrait;

    private EntityManagerInterface $entityManager;
    private float $bookingTax;
    private RoomBookedEventFactory $roomBookedEventFactory;
    private BookingFactory $bookingFactory;
    private MessageBusInterface $eventBus;

    public function __construct(
        EntityManagerInterface $entityManager,
        float $bookingTax,
        RoomBookedEventFactory $roomBookedEventFactory,
        BookingFactory $bookingFactory,
        MessageBusInterface $queryBus,
        MessageBusInterface $eventBus
    ) {
        $this->entityManager = $entityManager;
        $this->bookingTax = $bookingTax;
        $this->roomBookedEventFactory = $roomBookedEventFactory;
        $this->messageBus = $queryBus;
        $this->bookingFactory = $bookingFactory;
        $this->eventBus = $eventBus;
    }

    /**
     * Warning: Usage of this method should be wrapped in DB transaction
     *
     * @throws RoomNotFoundException
     */
    public function book(int $roomId, int $clientId, DateTimeImmutable $startDate, DateTimeImmutable $endDate): BookingCreated
    {
        $roomPriceDTO = $this->getRoomPrice($roomId);
        $booking = $this->bookingFactory->create($roomId, $clientId, $startDate, $endDate, $roomPriceDTO->getPrice());

        $this->entityManager->persist($booking);

        $roomBookedEvent = $this->roomBookedEventFactory->createFromBooking($booking);
        //TODO: use event bus
        $this->eventBus->dispatch($roomBookedEvent);

        return new BookingCreated($booking, $roomBookedEvent->getRedirectionUrl());
    }

    /**
     * TODO: Create separate client Class
     *
     * @throws RoomNotFoundException
     */
    private function getRoomPrice(int $roomId): RoomPriceDTO
    {
        $result = $this->handle(new RoomPriceQuery($roomId));

        if ($result instanceof Exception) {
            throw $result;
        }

        return $result;
    }
}
