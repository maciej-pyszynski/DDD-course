<?php

declare(strict_types=1);

namespace App\Booking\Infrastructure\DTO;

use DateTimeImmutable;

class BookingCreatedDTO
{
    private string $bookingId;
    private int $roomId;
    private int $clientId;
    private DateTimeImmutable $startDate;
    private DateTimeImmutable $endDate;

    public function __construct(string $bookingId, int $roomId, int $clientId, DateTimeImmutable $startDate, DateTimeImmutable $endDate, string $redirectionUrl)
    {
        $this->bookingId = $bookingId;
        $this->roomId = $roomId;
        $this->clientId = $clientId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function getBookingId(): string
    {
        return $this->bookingId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }
}