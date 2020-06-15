<?php

declare(strict_types=1);

namespace App\Core\Application\MessageBus;


interface Response
{
    /**
     * @return mixed
     */
    public function getValue();
}