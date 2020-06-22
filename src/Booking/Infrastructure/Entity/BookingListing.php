<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\Entity;

use App\Booking\Infrastructure\Entity\BookingListing\Room;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Booking\Infrastructure\Repository\BookingListingRepository;

/**
 * @ORM\Entity(repositoryClass=BookingListingRepository::class)
 * @ORM\Table(name="booking_booking_listing",
 *  indexes={
 *          @ORM\Index(name="start_date", columns={"start_date"}),
 *          @ORM\Index(name="end_date", columns={"end_date"})
 *     }
 * )
 *
 */
class BookingListing
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private string $id;

    /**
     * @ORM\Column(name="start_date", type="datetime_immutable")
     */
    private DateTimeImmutable $startDate;

    /**
     * @ORM\Column(name="end_date", type="datetime_immutable")
     */
    private DateTimeImmutable $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Booking\Infrastructure\Entity\BookingListing\Room")
     * @ORM\JoinColumn(name="room_id", nullable=false, referencedColumnName="id")
     */
    private ?Room $room = null;

    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    private int $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="client_name", type="string")
     */
    private string $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="client_surname", type="string")
     */
    private string $clientSurname;

    /**
     * @var string
     *
     * @ORM\Column(name="client_phone", type="string", nullable=true)
     */
    private string $clientPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="client_email", type="string", nullable=true)
     */
    private string $clientEmail;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    /**
     * @param DateTimeImmutable $startDate
     */
    public function setStartDate(DateTimeImmutable $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }

    /**
     * @param DateTimeImmutable $endDate
     */
    public function setEndDate(DateTimeImmutable $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return Room|null
     */
    public function getRoom(): ?Room
    {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     */
    public function setClientName(string $clientName): void
    {
        $this->clientName = $clientName;
    }

    /**
     * @return string
     */
    public function getClientSurname(): string
    {
        return $this->clientSurname;
    }

    /**
     * @param string $clientSurname
     */
    public function setClientSurname(string $clientSurname): void
    {
        $this->clientSurname = $clientSurname;
    }

    /**
     * @return string
     */
    public function getClientPhone(): string
    {
        return $this->clientPhone;
    }

    /**
     * @param string $clientPhone
     */
    public function setClientPhone(string $clientPhone): void
    {
        $this->clientPhone = $clientPhone;
    }

    /**
     * @return string
     */
    public function getClientEmail(): string
    {
        return $this->clientEmail;
    }

    /**
     * @param string $clientEmail
     */
    public function setClientEmail(string $clientEmail): void
    {
        $this->clientEmail = $clientEmail;
    }
}