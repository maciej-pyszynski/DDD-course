<?php

declare(strict_types=1);

namespace App\Room\Api\Query;

final class RoomPriceQuery
{
    private int $roomId;

    public function __construct(int $roomId)
    {
        $this->roomId = $roomId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }
}
