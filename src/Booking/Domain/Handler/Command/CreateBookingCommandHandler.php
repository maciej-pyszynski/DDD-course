<?php

declare(strict_types=1);

namespace App\Booking\Domain\Handler\Command;

use App\Booking\Domain\API\Command\BookingCreatedDTO;
use App\Booking\Domain\API\Command\CreateBookingCommand;
use App\Booking\Domain\Service\Booker;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateBookingCommandHandler implements MessageHandlerInterface
{
    private Booker $booker;

    public function __construct(Booker $booker)
    {
        $this->booker = $booker;
    }

    public function __invoke(CreateBookingCommand $createBookingCommand): BookingCreatedDTO
    {
        return $this->booker->book($createBookingCommand);
    }
}
