<?php


namespace CodelyTv\OpenFlight\Flights\Application\Find;

use CodelyTv\OpenFlight\Flights\Domain\FlightRepository;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;

class FlightsFinder
{
    public function __construct(private FlightRepository $repository)
    {
    }

    public function __invoke(string $destination, DateTimeValueObject $dateTimeFrom, DateTimeValueObject $dateTimeTo): FindFlightsResponse
    {
        $flights = $this->repository->findBetweenDates($destination, $dateTimeFrom, $dateTimeTo);

        $flightsResponse = [];
        foreach ($flights as $flight) {
            array_push(
                $flightsResponse,
                new FindFlightResponse(
                    $flight->getOrigin(),
                    $flight->getDestination(),
                    $flight->getFlightHours(),
                    $flight->getPrice()->getValue(),
                    $flight->getPrice()->getCurrency(),
                    DateTimeValueObject::convertDateTimeToString($flight->getDepartureDate()),
                    $flight->getAircraft(),
                    $flight->getAirline()
                )
            );
        }
        return new FindFlightsResponse($flightsResponse);
    }

}