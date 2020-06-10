<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

final class ClientId
{
    private int $id;

    public function __construct(int $id)
    {
        $this->validate($id);
        $this->id = $id;
    }

    public function getValue(): int
    {
        return $this->id;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validate(int $id): void
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('Id should be positive integer');
        }
    }
}