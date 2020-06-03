<?php

declare(strict_types=1);

namespace App\Booking\Controller\DTO;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class BookingDTO
{
    /**
     * @Assert\NotBlank()
     */
    private int $roomId;

    /**
     * @Assert\NotBlank()
     */
    private int $clientId;

    /**
     * @Assert\NotBlank()
     */
    private DateTimeImmutable $startDate;

    /**
     * @Assert\NotBlank()
     */
    private DateTimeImmutable $endDate;

    /**
     * BookingDTO constructor.
     * @param int $roomId
     * @param int $clientId
     * @param DateTimeImmutable $startDate
     * @param DateTimeImmutable $endDate
     */
    public function __construct(int $roomId, int $clientId, DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
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