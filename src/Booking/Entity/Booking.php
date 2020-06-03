<?php

namespace App\Booking\Entity;

use App\Booking\Repository\BookingRepository;
use App\Room\Entity\Room;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var DateTimeImmutable|null
     *
     * @ORM\Column(name="invoice_issue_date", type="datetime_immutable", nullable=true)
     */
    private $invoiceIssueDate;

    /**
     * @var float
     *
     * @ORM\Column(name="tax_percentage", type="float")
     */
    private $taxPercentage;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer")
     */
    private $total;

    /**
     * @var Client|null
     *
     * @ORM\ManyToOne(targetEntity="\App\Booking\Entity\Client")
     * @ORM\JoinColumn(name="client_id", nullable=false)
     */
    private $client;

    /**
     * @var null|Room
     *
     * @ORM\ManyToOne(targetEntity="\App\Room\Entity\Room")
     * @ORM\JoinColumn(name="room_id", nullable=false)
     */
    private $room;

    public function getId(): ?int
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
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
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
     * @return Client|null
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return ?Room
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
