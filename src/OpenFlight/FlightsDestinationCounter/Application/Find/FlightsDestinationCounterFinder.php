<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Application\Find;


use CodelyTv\OpenFlight\FlightsDestinationCounter\Domain\FlightsDestinationCounterNotExist;
use CodelyTv\OpenFlight\FlightsDestinationCounter\Domain\FlightsDestinationCounterRepository;

class FlightsDestinationCounterFinder
{

    public function __construct(private FlightsDestinationCounterRepository $repository)
    {
    }

    public function __invoke(string $flightDestination): FlightsDestinationCounterResponse
    {
        $counter = $this->repository->search($flightDestination);

        if (empty($counter)) {
            throw new FlightsDestinationCounterNotExist();
        }

        return new FlightsDestinationCounterResponse($counter->getFlightDestination(), $counter->getTotal());
    }
}