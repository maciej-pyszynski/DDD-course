<?php

declare(strict_types=1);

namespace App\Core\Domain\Exception;

use App\Core\Domain\Validation\ValidationViolation;
use InvalidArgumentException;
use Throwable;

class ValidationAwareException extends InvalidArgumentException implements ValidationAwareExceptionInterface
{
    /** @var ValidationViolation[] */
    protected $violations = [];

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function addViolation(ValidationViolation $violation): void
    {
        if (!in_array($violation, $this->violations)) {
            $this->violations[] = $violation;
        }
    }

    public function setViolation(array $violations)
    {
        foreach ($violations as $violation) {
            $this->addViolation($violation);
        }
    }

    /**
     * @return ValidationViolation[]
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
