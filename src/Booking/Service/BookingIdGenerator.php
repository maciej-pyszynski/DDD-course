<?php

namespace App\Booking\Service;

use App\Booking\Domain\Port\IdGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

class BookingIdGenerator implements IdGenerator
{
    private UuidFactoryInterface $uuidGenerator;

    public function __construct(UuidFactoryInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function generate(): string
    {
        return $this->getUuidGenerator()->uuid4()->toString();
    }

    private function getUuidGenerator(): UuidFactoryInterface
    {
        if (null === $this->uuidGenerator) {
            $this->uuidGenerator = Uuid::getFactory();
        }

        return $this->uuidGenerator;
    }
}
