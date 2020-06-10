<?php

declare(strict_types=1);

namespace App\Booking\Domain\Port;

interface IdGenerator
{
    public function generate(): string;
}
