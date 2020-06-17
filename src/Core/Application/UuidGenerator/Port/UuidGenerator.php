<?php

declare(strict_types=1);

namespace App\Core\Application\UuidGenerator\Port;

interface UuidGenerator
{
    public function generate(): string;
}