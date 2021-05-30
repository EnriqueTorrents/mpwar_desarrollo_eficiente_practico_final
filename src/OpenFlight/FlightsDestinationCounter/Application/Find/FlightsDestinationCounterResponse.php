<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

class FlightsDestinationCounterResponse implements Response
{
    public function __construct(private string $flightDestination, private int $total)
    {
    }


    public function getFlightDestination(): string
    {
        return $this->flightDestination;
    }

    public function getTotal(): int
    {
        return $this->total;
    }


}