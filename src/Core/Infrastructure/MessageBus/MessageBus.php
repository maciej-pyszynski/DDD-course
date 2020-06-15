<?php

namespace App\Core\Infrastructure\MessageBus;

use App\Core\Application\MessageBus\Response as ResponseInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class MessageBus
{
    /** @var MessageBusInterface */
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param $message
     * @return ResponseInterface[]
     */
    public function dispatch($message): array
    {
        $envelope = $this->messageBus->dispatch($message);
        /** @var HandledStamp[] $handledStamps */
        $handledStamps = $envelope->all(HandledStamp::class);

        $responses = [];

        foreach ($handledStamps as $handledStamp) {
            $responses[] = new Response($handledStamp->getResult());
        }

        return $responses;
    }
}
