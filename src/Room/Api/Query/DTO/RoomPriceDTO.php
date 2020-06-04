<?php

declare(strict_types=1);

namespace App\Room\Api\Query\DTO;

interface RoomPriceDTO
{
    public function getPrice(): int;
}
