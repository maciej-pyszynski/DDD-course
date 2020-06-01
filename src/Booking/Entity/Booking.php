<?php

namespace App\Booking\Entity;

use App\Booking\Repository\BookingRepository;
use App\Room\Entity\Room;
use DateTime;
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
     * @var DateTime
     *
     * @ORM\Column(name="booking_date", type="datetime_immutable")
     */
    private $bookingDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="start_date", type="datetime_immutable")
     */
    private $startDate;

    /**
     * @var DateTime
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
     * @var DateTime|null
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
     * @return DateTime
     */
    public function getBookingDate(): DateTime
    {
        return $this->bookingDate;
    }

    /**
     * @param DateTime $bookingDate
     */
    public function setBookingDate(DateTime $bookingDate): void
    {
        $this->bookingDate = $bookingDate;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate): void
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
     * @return DateTime|null
     */
    public function getInvoiceIssueDate(): ?DateTime
    {
        return $this->invoiceIssueDate;
    }

    /**
     * @param DateTime|null $invoiceIssueDate
     */
    public function setInvoiceIssueDate(?DateTime $invoiceIssueDate): void
    {
        $this->invoiceIssueDate = $invoiceIssueDate;
    }
}
