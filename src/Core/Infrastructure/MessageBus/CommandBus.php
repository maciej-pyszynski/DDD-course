<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\MessageBus;

use App\Core\Application\MessageBus\CommandBus as CommandBusInterface;
use App\Core\Application\MessageBus\Response;

class CommandBus implements CommandBusInterface
{
    private MessageBus $messageBus;

    public function __construct(MessageBus $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function dispatch($message): ?Response
    {
        return $this->messageBus->dispatch($message);
    }

}