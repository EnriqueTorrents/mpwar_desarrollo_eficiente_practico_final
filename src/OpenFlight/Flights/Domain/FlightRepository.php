<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;

interface FlightRepository
{
    public function create(Flight $flight): void;

    public function findBetweenDates(DateTimeValueObject $dateTimeFrom, DateTimeValueObject $dateTimeTo): array;
}