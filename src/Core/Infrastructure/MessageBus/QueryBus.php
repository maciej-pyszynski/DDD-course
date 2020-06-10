<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\MessageBus;

use App\Core\Application\MessageBus\Exception\MissingQueryResponseException;
use App\Core\Application\MessageBus\QueryBus as QueryBusInterface;
use App\Core\Application\MessageBus\Response;

class QueryBus implements QueryBusInterface
{
    private MessageBus $messageBus;

    public function __construct(MessageBus $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @throws MissingQueryResponseException
     */
    public function dispatch($message): Response
    {
        $response = $this->messageBus->dispatch($message);

        if (null === $response) {
            throw new MissingQueryResponseException();
        }

        return $response;
    }

}