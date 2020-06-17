<?php

namespace App\Core\Infrastructure\UuidGenerator\Adapter;

use App\Core\Application\UuidGenerator\Port\UuidGenerator as UuidGeneratorInterface;
use Ramsey\Uuid\UuidFactoryInterface;

class UuidGenerator implements UuidGeneratorInterface
{
    private UuidFactoryInterface $uuidGenerator;

    public function __construct(UuidFactoryInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function generate(): string
    {
        return $this->uuidGenerator->uuid4()->toString();
    }
}
