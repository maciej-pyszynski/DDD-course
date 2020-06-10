<?php

declare(strict_types=1);

namespace App\Core\Application\MessageBus;

interface CommandBus
{
    public function dispatch($message): ?Response;
}