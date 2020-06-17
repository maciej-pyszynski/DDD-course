<?php

declare(strict_types=1);

namespace App\Booking\Application\Handler\Command;

use App\Booking\Application\API\Command\BookingCreatedDTO as ApplicationBookingCreatedDTO;
use App\Booking\Application\API\Command\CreateBookingCommand as ApplicationCreateBookingCommand;
use App\Booking\Domain\API\Command\BookingCreatedDTO as DomainBookingCreatedDTO;
use App\Booking\Domain\API\Command\CreateBookingCommand as DomainCreateBookingCommand;
use App\Booking\Domain\Exception\BookingRangeStartDateShouldBeInTheFutureException;
use App\Booking\Domain\Exception\RoomNotFoundException;
use App\Booking\Domain\ValueObject\BookingRange;
use App\Core\Application\MessageBus\CommandBus;
use App\Core\Domain\ValueObject\ClientId;
use App\Core\Domain\ValueObject\RoomId;
use App\Core\Infrastructure\Exception\ValidationException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateBookingCommandHandler implements MessageHandlerInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @throws ValidationException
     */
    public function __invoke(ApplicationCreateBookingCommand $command): ApplicationBookingCreatedDTO
    {
        try {
            /** @var DomainBookingCreatedDTO $bookingCreatedDTO */
            $bookingCreatedDTO = $this->commandBus
                ->dispatch(
                    new DomainCreateBookingCommand(
                        new RoomId($command->getRoomId()),
                        new ClientId($command->getClientId()),
                        new BookingRange($command->getStartDate(), $command->getEndDate())
                    )
                )->getValue();
        } catch (HandlerFailedException $exception) {
            $exception = $exception->getNestedExceptions()[0];

            if ($exception instanceof BookingRangeStartDateShouldBeInTheFutureException) {
                throw new ValidationException($exception->getMessage(), 'startDate');
            }

            if ($exception instanceof RoomNotFoundException) {
                throw new ValidationException($exception->getMessage(), 'roomId');
            }

            echo ($exception->getMessage()); exit;
        }

        return new ApplicationBookingCreatedDTO(
            $bookingCreatedDTO->getBookingId()->getValue(),
            $bookingCreatedDTO->getRedirectUrl()
        );
    }
}
