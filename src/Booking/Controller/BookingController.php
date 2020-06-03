<?php

declare(strict_types=1);

namespace App\Booking\Controller;

use App\Booking\Controller\DTO\BookingDTO;
use App\Booking\Service\Booker;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @var Booker
     */
    private Booker $booker;

    public function __construct(Booker $booker)
    {
        $this->booker = $booker;
    }

    /**
     * @Route("/api/bookings", methods={"POST"})
     * @ParamConverter("bookingDTO", class="\App\Booking\Controller\DTO\BookingDTO", converter="fos_rest.request_body")
     */
    public function bookAction(BookingDTO $bookingDTO): JsonResponse
    {
        //TODO: Add validation of room and client

        $booking = $this->booker->book(
            $bookingDTO->getRoomId(),
            $bookingDTO->getClientId(),
            $bookingDTO->getStartDate(),
            $bookingDTO->getEndDate()
        );

        $this->get('doctrine')->getManager()->flush();

        return $this->json([
            'id' => $booking->getId(),
        ], Response::HTTP_CREATED);
    }
}
