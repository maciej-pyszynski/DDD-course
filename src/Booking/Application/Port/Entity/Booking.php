<?php

namespace App\Booking\Application\Port\Entity;


use DateTimeImmutable;

interface Booking
{
    public function getId(): string;

    public function getBookingDate(): DateTimeImmutable;

    public function setBookingDate(DateTimeImmutable $bookingDate): void;

    public function getStartDate(): DateTimeImmutable;

    public function setStartDate(DateTimeImmutable $startDate): void;

    public function getEndDate(): DateTimeImmutable;

    public function setEndDate(DateTimeImmutable $endDate): void;

    public function getUnitPrice(): float;

    public function setUnitPrice(float $unitPrice): void;

    public function getQuantity(): int;

    public function setQuantity(int $quantity): void;

    public function getTaxPercentage(): float;

    public function setTaxPercentage(float $taxPercentage): void;

    public function getTotal(): int;

    public function setTotal(int $total): void;

    public function getClientId(): ?int;

    public function setClientId(int $clientId): void;

    public function getRoomId(): ?int;

    public function setRoomId(int $roomId): void;

    public function getInvoiceIssueDate(): ?DateTimeImmutable;

    public function setInvoiceIssueDate(?DateTimeImmutable $invoiceIssueDate): void;
}