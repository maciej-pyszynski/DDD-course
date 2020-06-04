<?php

declare(strict_types=1);

namespace App\Room\QueryHandler;

use App\Room\Api\Exception\RoomNotFoundException;
use App\Room\Api\Query\DTO\RoomPriceDTO as RoomPriceDTOInterface;
use App\Room\Api\Query\RoomPriceQuery;
use App\Room\QueryHandler\DTO\RoomPriceDTO;
use App\Room\Repository\RoomRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RoomPriceQueryHandler implements MessageHandlerInterface
{
    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * @return RoomPriceDTOInterface|RoomNotFoundException
     */
    public function __invoke(RoomPriceQuery $query)
    {
        try {
            $price = $this->roomRepository->getDefaultQueryBuilder('r')
                ->select(['r.price'])
                ->andWhere('r.id = :id')
                ->setParameter('id', $query->getRoomId())
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException|NonUniqueResultException $e) {
            return new RoomNotFoundException('', 0, $e);
        }

        return new RoomPriceDTO((int)$price);
    }
}
