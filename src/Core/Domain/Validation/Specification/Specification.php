<?php

declare(strict_types=1);

namespace App\Core\Domain\Validation\Specification;

use App\Core\Domain\Validation\ValidationViolation;
use InvalidArgumentException;

abstract class Specification implements SpecificationInterface
{
    /** @var ValidationViolation[] */
    protected $violations = [];

    /**
     * @param mixed $object
     *
     * @throws InvalidArgumentException
     */
    abstract public function isSatisfiedBy($object): bool;

    /**
     * @return ValidationViolation[]
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
