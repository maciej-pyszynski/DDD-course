<?php

declare(strict_types=1);

namespace App\Booking\Application\Mapper;

use App\Booking\Application\Port\Entity\Booking as InfrastructureBooking;
use App\Booking\Domain\Model\Booking as DomainBooking;

class BookingMapper
{
    public function mapFromDomainToInfrastructure(DomainBooking $domainBooking, InfrastructureBooking $infrastructureBooking): void
    {
        $infrastructureBooking->setRoomId($domainBooking->getRoomId()->getValue());
        $infrastructureBooking->setBookingDate($domainBooking->getBookingDate()->getValue());
        $infrastructureBooking->setClientId($domainBooking->getClientId()->getValue());
        $infrastructureBooking->setStartDate($domainBooking->getBookingRange()->getStartDate());
        $infrastructureBooking->setEndDate($domainBooking->getBookingRange()->getEndDate());

        $unitPriceValueObject = $domainBooking->getUnitPrice();
        $infrastructureBooking->setUnitPrice($unitPriceValueObject ? $unitPriceValueObject->getAmount() : null);
    }
}
