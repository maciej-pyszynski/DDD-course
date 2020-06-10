<?php

declare(strict_types=1);

namespace App\Core\Application\MessageBus;

interface QueryBus
{
    public function dispatch($message): Response;
}
