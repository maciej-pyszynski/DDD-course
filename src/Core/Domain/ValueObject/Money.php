<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use InvalidArgumentException;

class Money
{
    private int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    private function validate(int $amount)
    {
        if (0 >= $amount) {
            throw new InvalidArgumentException('Amount must be unsigned int');
        }
    }
}