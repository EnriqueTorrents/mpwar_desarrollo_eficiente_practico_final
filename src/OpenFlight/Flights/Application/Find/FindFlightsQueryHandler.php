<?php


namespace CodelyTv\OpenFlight\Flights\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;

class FindFlightsQueryHandler implements QueryHandler
{
    public function __construct(private FlightsFinder $flightsFinder)
    {
    }

    public function __invoke(FindFlightsQuery $query): FindFlightsResponse
    {
        $dateTimeFrom = DateTimeValueObject::createDateTimeValueObjectFromString($query->getDateFrom());
        $dateTimeTo = DateTimeValueObject::createDateTimeValueObjectFromString($query->getDateTo());
        return $this->flightsFinder->__invoke($query->getDestination(), $dateTimeFrom, $dateTimeTo);
    }

}