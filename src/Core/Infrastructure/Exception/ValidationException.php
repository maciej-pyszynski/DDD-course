<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Exception;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    private ?string $property;

    public function __construct($message = "", string $property = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->property = $property;
    }

    public function getProperty(): ?string
    {
        return $this->property;
    }
}