<?php

declare(strict_types=1);

namespace App\Core\Domain\Exception;

use App\Core\Domain\Validation\ValidationViolation;

class ValidationExceptionFactory
{
    public function createFromException($property, \Throwable $exception)
    {
        $violation = new ValidationViolation($property, $exception->getMessage(), 'message', $exception->getMessage());

        $exception = new ValidationAwareException();
        $exception->addViolation($violation);

        return $exception;
    }
}