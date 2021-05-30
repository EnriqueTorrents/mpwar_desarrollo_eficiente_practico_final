<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\ValueObject\Uuid;

interface FlightRepository
{
    public function create(Flight $flight): void;

    public function search(Uuid $flightId): ?Flight;
}