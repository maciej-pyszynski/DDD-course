<?php

namespace App\Room\Repository;

use App\Room\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    public function getDefaultQueryBuilder(string $alias, ?bool $availableForBooking = true): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder($alias);

        if(null !== $availableForBooking) {
            $queryBuilder->andWhere($alias.'.availableForBooking = :availableForBooking')
                ->setParameter('availableForBooking', $availableForBooking);
        }

        return $queryBuilder;
    }
}
