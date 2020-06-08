<?php

declare(strict_types=1);

namespace App\Booking\Controller;

use App\Booking\Controller\DTO\BookingDTO;
use App\Booking\Service\Booker;
use App\Room\Api\Exception\RoomNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
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

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $this->get('doctrine')->getManager();

        try {
            $bookingDTO = $this->booker->book(
                $bookingDTO->getRoomId(),
                $bookingDTO->getClientId(),
                $bookingDTO->getStartDate(),
                $bookingDTO->getEndDate()
            );
        } catch (RoomNotFoundException $e) {
            return $this->json([
                'error' => sprintf('Room %d doesn\'t exists', $bookingDTO->getRoomId())
            ], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        return $this->json([
            'id' => $bookingDTO->getBooking()->getId(),
            'redirection' => $bookingDTO->getRedirectUrl()
        ], Response::HTTP_CREATED);
    }
}
