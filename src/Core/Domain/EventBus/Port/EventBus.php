<?php

declare(strict_types=1);

namespace App\Core\Domain\EventBus\Port;

interface EventBus
{
    public function dispatch($message): void ;
}