<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\MessageBus;

use App\Core\Application\MessageBus\Exception\MissingQueryResponseException;
use App\Core\Application\MessageBus\Exception\QueryShouldNotBeHandledMultipleTimesException;
use App\Core\Application\MessageBus\QueryBus as QueryBusInterface;
use App\Core\Application\MessageBus\Response;
use Exception;

class QueryBus implements QueryBusInterface
{
    private MessageBus $messageBus;

    public function __construct(MessageBus $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @throws MissingQueryResponseException
     * @throws QueryShouldNotBeHandledMultipleTimesException
     * @throws Exception
     */
    public function dispatch($message): Response
    {
        $responses = $this->messageBus->dispatch($message);

        if ($responses instanceof Exception) {
            throw $responses;
        }

        $responseCount = count($responses);
        if (0 === $responseCount) {
            throw new MissingQueryResponseException();
        }

        if(1 < $responseCount) {
            throw new QueryShouldNotBeHandledMultipleTimesException();
        }

        return current($responses);
    }

}