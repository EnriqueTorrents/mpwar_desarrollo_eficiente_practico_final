<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Users\Infrastructure;


use CodelyTv\OpenFlight\Flights\Domain\Flight;
use CodelyTv\OpenFlight\Flights\Domain\FlightRepository;
use CodelyTv\OpenFlight\Users\Domain\User;
use CodelyTv\OpenFlight\Users\Domain\UserRepository;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;


final class MysqlFlightRepository implements FlightRepository
{
    public function __construct(private Mysql $mysql)
    {
    }

    public function create(Flight $flight): void
    {
        $sql = 'INSERT INTO flight VALUES(:id, :origin, :destination, :flightHours, :price, :currency, :departureDate, :aircraft, :airline)';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $flight->ID()->value());
        $statement->bindValue(':origin', $flight->getOrigin());
        $statement->bindValue(':destination', $flight->getDestination());
        $statement->bindValue(':flightHours', $flight->getFlightHours());
        $statement->bindValue(':price', $flight->getPrice());
        $statement->bindValue(':currency', $flight->getCurrency());
        $statement->bindValue(':departureDate', $flight->getDepartureDate());
        $statement->bindValue(':aircraft', $flight->getAircraft());
        $statement->bindValue(':airline', $flight->getAirline());
        $statement->execute();
    }


}