<?php

namespace App\Booking\Infrastructure\Entity;

use App\Booking\Application\Port\Entity\Booking as BookingInterface;
use App\Booking\Infrastructure\Repository\BookingRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 * @ORM\Table(name="booking_booking")
 */
class Booking implements BookingInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private string $id;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(name="booking_date", type="datetime_immutable")
     */
    private $bookingDate;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(name="start_date", type="datetime_immutable")
     */
    private $startDate;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(name="end_date", type="datetime_immutable")
     */
    private $endDate;

    /**
     * @var float
     *
     * @ORM\Column(name="unit_price", type="integer")
     */
    private $unitPrice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    private $clientId;

    /**
     * @var null|int
     *
     * @ORM\Column(name="room_id", type="integer")
     */
    private $roomId;

    /**
     * Booking constructor.
     * @param $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }


    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getBookingDate(): DateTimeImmutable
    {
        return $this->bookingDate;
    }

    /**
     * @param DateTimeImmutable $bookingDate
     */
    public function setBookingDate(DateTimeImmutable $bookingDate): void
    {
        $this->bookingDate = $bookingDate;
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
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getTaxPercentage(): float
    {
        return $this->taxPercentage;
    }

    /**
     * @param float $taxPercentage
     */
    public function setTaxPercentage(float $taxPercentage): void
    {
        $this->taxPercentage = $taxPercentage;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @return int|null
     */
    public function getClientId(): ?int
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
     * @return ?int
     */
    public function getRoomId(): ?int
    {
        return $this->roomId;
    }

    /**
     * @param int $roomId
     */
    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getInvoiceIssueDate(): ?DateTimeImmutable
    {
        return $this->invoiceIssueDate;
    }

    /**
     * @param DateTimeImmutable|null $invoiceIssueDate
     */
    public function setInvoiceIssueDate(?DateTimeImmutable $invoiceIssueDate): void
    {
        $this->invoiceIssueDate = $invoiceIssueDate;
    }
}
