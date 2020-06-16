<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\MessageBus;

use App\Core\Application\MessageBus\Port\EventBus as EventBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class EventBus implements EventBusInterface
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function dispatch($message): void
    {
        $this->eventBus->dispatch($message);
    }
}
