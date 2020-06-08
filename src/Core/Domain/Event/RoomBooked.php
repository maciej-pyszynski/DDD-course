<?php

declare(strict_types=1);

namespace App\Core\Domain\Event;

use DateTimeImmutable;

final class RoomBooked
{
    private string $bookingId;
    private int $roomId;
    private int $clientId;
    private DateTimeImmutable $startDate;

    private DateTimeImmutable $endDate;
    private string $redirectionUrl;

    public function __construct(string $bookingId, int $roomId, int $clientId, DateTimeImmutable $startDate, DateTimeImmutable $endDate, string $redirectionUrl)
    {
        $this->bookingId = $bookingId;
        $this->roomId = $roomId;
        $this->clientId = $clientId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->redirectionUrl = $redirectionUrl;
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

    public function getRedirectionUrl(): string
    {
        return $this->redirectionUrl;
    }

    public function setRedirectionUrl(string $redirectionUrl): void
    {
        $this->redirectionUrl = $redirectionUrl;
    }
}