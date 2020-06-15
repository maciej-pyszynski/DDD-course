<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\MessageBus;

use Symfony\Component\Messenger\MessageBusInterface;

class EventBus
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