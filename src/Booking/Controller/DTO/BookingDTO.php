<?php

declare(strict_types=1);

namespace App\Booking\Controller\DTO;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookingDTO
{
    /**
     * @NotBlank()
     */
    private int $roomId;

    /**
     * @NotBlank()
     */
    private int $clientId;

    /**
     * @NotBlank()
     */
    private DateTime $startDate;

    /**
     * @NotBlank()
     */
    private DateTime $endDate;

    /**
     * BookingDTO constructor.
     * @param int $roomId
     * @param int $clientId
     * @param DateTime $startDate
     * @param DateTime $endDate
     */
    public function __construct(int $roomId, int $clientId, DateTime $startDate, DateTime $endDate)
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
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }
}