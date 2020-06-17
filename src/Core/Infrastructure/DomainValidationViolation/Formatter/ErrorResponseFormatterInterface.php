<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\DomainValidationViolation\Formatter;

interface ErrorResponseFormatterInterface
{
    public function format(array $violations): string;
}
