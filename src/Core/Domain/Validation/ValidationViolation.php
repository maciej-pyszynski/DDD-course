<?php

declare(strict_types=1);

namespace App\Core\Domain\Validation;

class ValidationViolation
{
    /** @var string */
    private $property;

    /** @var string */
    private $message;

    /** @var string */
    private $domain;

    /** @var string|null */
    private $messageKey;

    /** @var array */
    private $parameters;

    public function __construct(string $property, string $message, string $domain, string $messageKey = null, $parameters = [])
    {
        $this->property = $property;
        $this->message = $message;
        $this->domain = $domain;
        $this->messageKey = $messageKey;
        $this->parameters = $parameters;
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getMessageKey(): ?string
    {
        return $this->messageKey;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }
}
