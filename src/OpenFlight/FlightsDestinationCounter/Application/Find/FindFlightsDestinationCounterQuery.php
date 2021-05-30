<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Query;

class FindFlightsDestinationCounterQuery implements Query
{
    public function __construct(private string $flightDestination)
    {
    }

    public function getFlightDestination(): string
    {
        return $this->flightDestination;
    }
}