<?php

declare(strict_types=1);

namespace App\Core\Domain\Validation\Validator;

use App\Core\Domain\Validation\Specification\SpecificationInterface;
use App\Core\Domain\Validation\ValidationViolation;

class Validator implements ValidatorInterface
{
    /** @var SpecificationInterface[] */
    private $specifications = [];

    public function __construct(array $specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * @param mixed $object
     *
     * @return ValidationViolation[]
     */
    public function validate($object): array
    {
        $violationList = [];

        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($object)) {
                $violationList = array_merge($violationList, $specification->getViolations());
            }
        }

        return $violationList;
    }
}
