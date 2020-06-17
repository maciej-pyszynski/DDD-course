<?php

declare(strict_types=1);

namespace App\Booking\Application\Adapter;

use App\Booking\Domain\Exception\RoomNotFoundException;
use App\Booking\Domain\Port\RoomUnitPriceRetriever as RoomUnitPriceRetrieverInterface;
use App\Core\Application\MessageBus\QueryBus;
use App\Core\Domain\ValueObject\Money;
use App\Core\Domain\ValueObject\RoomId;
use App\Room\Api\Exception\RoomNotFoundException as RoomDomainRoomNotFoundException;
use App\Room\Api\Query\DTO\RoomPriceDTO;
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
        try {
            /** @var RoomPriceDTO $response */
            $response = $this->queryBus->dispatch(new RoomPriceQuery($roomId->getValue()))->getValue();
        } catch (RoomDomainRoomNotFoundException $exception) {
            throw new RoomNotFoundException('Room doesn\'t exist', 0, $exception);
        }

        return new Money($response->getPrice());
    }
}
