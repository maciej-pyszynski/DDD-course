<?php

declare(strict_types=1);

namespace App\Core\Application\MessageBus\EventBus\Adapter;

use App\Core\Domain\EventBus\Port\EventBus as EventBusAliasInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class EventBus implements EventBusAliasInterface
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