<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\MessageBus;


use App\Core\Application\MessageBus\Response as ResponseInterface;

class Response implements ResponseInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}