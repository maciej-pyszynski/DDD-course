<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\UI\Controller;

use App\Booking\Application\API\Command\BookingCreatedDTO;
use App\Booking\Application\API\Command\CreateBookingCommand;
use App\Booking\Service\Booker;
use App\Core\Application\MessageBus\CommandBus;
use App\Room\Api\Exception\RoomNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    private CommandBus $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/api/bookings", methods={"POST"})
     * @ParamConverter("createBookingCommand", class="\App\Booking\Application\API\Command\CreateBookingCommand",
     *                                         converter="fos_rest.request_body")
     */
    public function bookAction(CreateBookingCommand $createBookingCommand): JsonResponse
    {
        //TODO: Add validation of room and client

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $this->get('doctrine')->getManager();

        try {
            /** @var BookingCreatedDTO $bookingCreatedDTO */
            $bookingCreatedDTO = $this->commandBus->dispatch($createBookingCommand)->getValue();
        } catch (RoomNotFoundException $e) {
            return $this->json([
                'error' => sprintf('Room %d doesn\'t exists', $createBookingCommand->getRoomId()),
            ], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        return $this->json([
            'id' => $bookingCreatedDTO->getBookingId(),
            'redirection' => $bookingCreatedDTO->getRedirectUrl(),
        ], Response::HTTP_CREATED);
    }
}
