<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\Service;

use App\Booking\Infrastructure\Client\ClientDomainClient;
use App\Booking\Infrastructure\DTO\BookingCreatedDTO;
use App\Booking\Infrastructure\Entity\BookingListing;
use App\Booking\Infrastructure\Factory\BookingListingFactory;
use App\Booking\Infrastructure\Mapper\BookingListingClientMapper;
use App\Booking\Infrastructure\Mapper\BookingListingDatesMapper;
use App\Booking\Infrastructure\Repository\BookingListing\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookingListingCreator
{
    private BookingListingFactory $bookingListingFactory;
    private RoomRepository $roomRepository;
    private EntityManagerInterface $entityManager;
    private ClientDomainClient $clientDomainClient;
    private BookingListingClientMapper $bookingClientListingMapper;
    private BookingListingDatesMapper $bookingListingDatesMapper;

    public function create(BookingCreatedDTO $bookingCreatedDTO): BookingListing
    {
        $bookingListing = $this->bookingListingFactory->create($bookingCreatedDTO->getBookingId());

        //get information about the room - conditionally
        // TODO: Separate to service
        $room = $this->roomRepository->find($bookingCreatedDTO->getRoomId());

        if (null === $room) {
            // TODO: write client for the room
        }

        $bookingListing->setRoom($room);

        //get information about client
        $clientInformation = $this->clientDomainClient->getClientInformation($bookingCreatedDTO->getClientId());

        //map
        $this->bookingListingDatesMapper->map($bookingCreatedDTO, $bookingListing);
        $this->bookingClientListingMapper->map($clientInformation, $bookingListing);

        //marking for store
        $this->entityManager->persist($bookingListing);
        $this->entityManager->persist($room);
    }
}