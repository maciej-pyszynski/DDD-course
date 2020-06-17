<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Exception;

use Exception;
use Throwable;

class ValidationExceptions extends Exception
{
    private array $exceptions;

    public function __construct($exceptions, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->exceptions = $exceptions;
    }

    /**
     * @return ValidationException[]
     */
    public function getExceptions(): array
    {
        return $this->exceptions;
    }

}