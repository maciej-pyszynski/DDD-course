<?php

declare(strict_types=1);

namespace App\Booking\Application\Adapter;

use App\Booking\Domain\Port\IdGenerator as IdGeneratorInterface;
use App\Core\Application\UuidGenerator\Port\UuidGenerator;

class IdGenerator implements IdGeneratorInterface
{
    /**
     * @var UuidGenerator
     */
    private UuidGenerator $generator;

    public function __construct(UuidGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function generate(): string
    {
        return $this->generator->generate();
    }
}
