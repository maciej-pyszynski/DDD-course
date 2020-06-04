<?php

declare(strict_types=1);

namespace App\Room\QueryHandler\DTO;

use App\Room\Api\Query\DTO\RoomPriceDTO as RoomPriceDTOInterface;

class RoomPriceDTO implements RoomPriceDTOInterface
{
    private int $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}