<?php


namespace CodelyTv\OpenFlight\Flights\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Query;

class FindFlightsQuery implements Query
{
    private string $destination;
    private string $dateFrom;
    private string $dateTo;

    public function __construct(string $destination, string $dateFrom, string $dateTo)
    {
        $this->destination = $destination;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    public function getDateTo(): string
    {
        return $this->dateTo;
    }

}