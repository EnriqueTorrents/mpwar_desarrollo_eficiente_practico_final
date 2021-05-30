<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

class FindFlightsDestinationCounterQueryHandler implements QueryHandler
{
    public function __construct(private FlightsDestinationCounterFinder $finder)
    {
    }

    public function __invoke(FindFlightsDestinationCounterQuery $query): FlightsDestinationCounterResponse
    {
        return $this->finder->__invoke($query->getFlightDestination());
    }

}