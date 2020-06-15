<?php

declare(strict_types=1);

namespace App\Core\Application\MessageBus\Adapter;

use App\Core\Application\MessageBus\Port\EventBus as EventBusAlias;
use App\Core\Domain\EventBus\Port\EventBus as EventBusAliasInterface;

class EventBus implements EventBusAliasInterface
{
    private EventBusAlias $eventBus;

    public function __construct(EventBusAlias $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function dispatch($message): void
    {
        $this->eventBus->dispatch($message);
    }
}
