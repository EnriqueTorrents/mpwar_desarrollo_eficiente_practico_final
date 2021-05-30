<?php


namespace CodelyTv\OpenFlight\Flights\Application;


use CodelyTv\Shared\Domain\Bus\Query\Response;

class FindFlightResponse implements Response
{
    public function __construct(
        private string $origin,
        private string $destination,
        private int $flightHours,
        private string $departureDate,
        private string $aircraft,
        private string $airline
    ) {
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getFlightHours(): int
    {
        return $this->flightHours;
    }

    public function getDepartureDate(): string
    {
        return $this->departureDate;
    }

    public function getAircraft(): string
    {
        return $this->aircraft;
    }

    public function getAirline(): string
    {
        return $this->airline;
    }

}