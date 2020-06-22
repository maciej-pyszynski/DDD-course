<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\Entity\BookingListing;

use Doctrine\ORM\Mapping as ORM;
use App\Booking\Infrastructure\Repository\BookingListing\RoomRepository;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 * @ORM\Table(name="booking_booking_listing_room")
 */
class Room
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="room_name", type="string", length=150)
     */
    private string $roomName;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getRoomName(): string
    {
        return $this->roomName;
    }

    /**
     * @param string $roomName
     */
    public function setRoomName(string $roomName): void
    {
        $this->roomName = $roomName;
    }
}