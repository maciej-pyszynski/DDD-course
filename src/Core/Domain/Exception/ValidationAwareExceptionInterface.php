<?php

declare(strict_types=1);

namespace App\Core\Domain\Exception;

use App\Core\Domain\Validation\ValidationViolation;

interface ValidationAwareExceptionInterface
{
    public function addViolation(ValidationViolation $violation): void;

    /**
     * @return ValidationViolation[]
     */
    public function getViolations(): array;
}
