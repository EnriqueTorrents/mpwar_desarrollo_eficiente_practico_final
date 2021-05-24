<?php


namespace CodelyTv\OpenFlight\Flights\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

class FindFlightsDestinationBetweenDatesResponse implements Response
{

    private array $flights;

    public function __construct($flights)
    {
        $this->flights = $flights;
    }

    public function getFlights(): array
    {
        return $this->flights;
    }

}