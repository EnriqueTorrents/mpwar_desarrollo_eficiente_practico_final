<?php


namespace CodelyTv\OpenFlight\Flights\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Query;

class FindFlightsQuery implements Query
{
    private string $dateFrom;
    private string $dateTo;

    public function __construct(string $dateFrom, string $dateTo)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
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