<?php

declare(strict_types=1);

namespace App\Core\Application\MessageBus\Port;

interface EventBus
{
    public function dispatch($message): void;
}
