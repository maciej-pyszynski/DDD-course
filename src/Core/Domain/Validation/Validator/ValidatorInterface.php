<?php

namespace App\Core\Domain\Validation\Validator;

use App\Core\Domain\Validation\ValidationViolation;

interface ValidatorInterface
{
    /**
     * @param mixed $object
     *
     * @return ValidationViolation[]
     */
    public function validate($object): array;
}
