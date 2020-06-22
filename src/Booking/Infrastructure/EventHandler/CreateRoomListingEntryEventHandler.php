<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\EventHandler;


use App\Core\Domain\Event\RoomBooked;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateRoomListingEntryEventHandler implements MessageHandlerInterface
{
    public function __invoke(RoomBooked $event)
    {

    }

}