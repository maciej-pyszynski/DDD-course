<?php

declare(strict_types=1);

namespace App\Booking\Application\API\Command;

use DateTimeImmutable;

final class CreateBookingCommand
{
    private int $roomId;
    private int $clientId;
    private DateTimeImmutable $startDate;
    private DateTimeImmutable $endDate;

    public function __construct(
        int $roomId,
        int $clientId,
        DateTimeImmutable $startDate,
        DateTimeImmutable $endDate
    ) {
        $this->roomId = $roomId;
        $this->clientId = $clientId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return int
     */
    public function getRoomId(): int
    {
        return $this->roomId;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }
}
