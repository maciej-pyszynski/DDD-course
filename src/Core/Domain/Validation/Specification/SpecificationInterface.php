<?php

declare(strict_types=1);

namespace App\Core\Domain\Validation\Specification;

use App\Core\Domain\Validation\ValidationViolation;
use InvalidArgumentException;

interface SpecificationInterface
{
    /**
     * @param mixed $object
     *
     * @throws InvalidArgumentException
     */
    public function isSatisfiedBy($object): bool;

    /**
     * @return ValidationViolation[]
     */
    public function getViolations(): array;
}
