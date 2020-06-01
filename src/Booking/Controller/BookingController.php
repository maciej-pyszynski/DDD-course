<?php

declare(strict_types=1);

namespace App\Booking\Controller;

use App\Booking\Controller\DTO\BookingDTO;
use App\Booking\Entity\Client;
use App\Booking\Service\Booker;
use App\Room\Entity\Room;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @Route("/api/bookings", methods={"POST"})
     * @ParamConverter("bookingDTO", class="App\Booking\Controller\DTO\BookingDTO", converter="fos_rest.request_body")
     */
    public function bookAction(BookingDTO $bookingDTO): JsonResponse
    {
        //TODO: Add validation room and client

        $booker = $this->get(Booker::class);

        $room = $this->getDoctrine()->getRepository(Room::class)->find($bookingDTO->getRoomId());
        $client = $this->getDoctrine()->getRepository(Client::class)->find($bookingDTO->getClientId());

        $booking = $booker->book($room, $client, $bookingDTO->getStartDate(), $bookingDTO->getEndDate());

        return $this->json([
            'id', $booking->getId()
        ], Response::HTTP_CREATED);
    }
}