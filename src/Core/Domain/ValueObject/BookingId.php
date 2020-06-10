<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;


final class BookingId
{
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->validate($uuid);
        $this->uuid = $uuid;
    }

    public function getValue(): string
    {
        return $this->uuid;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validate(string $uuid): void
    {
        if (strlen($uuid) !== 36) {
            throw new \InvalidArgumentException('Value should be of length 32');
        }
    }
}