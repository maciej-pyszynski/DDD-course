<?php

declare(strict_types=1);

namespace App\Booking\Application\Adapter;

use App\Booking\Domain\Port\RoomUnitPriceRetriever as RoomUnitPriceRetrieverInterface;
use App\Core\Application\MessageBus\QueryBus;
use App\Core\Domain\ValueObject\Money;
use App\Core\Domain\ValueObject\RoomId;
use App\Room\Api\Query\RoomPriceQuery;

class RoomUnitPriceRetriever implements RoomUnitPriceRetrieverInterface
{
    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function getRoomUnitPrice(RoomId $roomId): Money
    {
        $response = $this->queryBus->dispatch(new RoomPriceQuery($roomId->getValue()));

        return $response->getValue();
    }

}