<?php

declare(strict_types=1);

namespace App\Booking\Domain\Port;

use App\Core\Domain\ValueObject\Money;
use App\Core\Domain\ValueObject\RoomId;

interface RoomUnitPriceRetriever
{
    public function getRoomUnitPrice(RoomId $roomId): Money;
}