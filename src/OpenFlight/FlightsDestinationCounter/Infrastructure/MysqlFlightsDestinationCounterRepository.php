<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Infrastructure;

use CodelyTv\OpenFlight\FlightsDestinationCounter\Domain\FlightsDestinationCounter;
use CodelyTv\OpenFlight\FlightsDestinationCounter\Domain\FlightsDestinationCounterRepository;
use CodelyTv\OpenFlight\FlightsDestinationCounter\Domain\FlightsDestinationCounterTotal;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;

final class MysqlFlightsDestinationCounterRepository implements FlightsDestinationCounterRepository
{
    public function __construct(private Mysql $mysql)
    {
    }

    public function create(FlightsDestinationCounter $counter): void
    {
        $sql = 'INSERT IGNORE INTO flights_destination_counter VALUES(:id, :destination, :total, :existing_flights)';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $counter->getId()->value());
        $statement->bindValue(':destination', $counter->getFlightDestination());
        $statement->bindValue(':total', $counter->getTotal()->value());
        $statement->bindValue(
            ':existing_flights',
            json_encode(
                FlightsDestinationCounter::convertExistingFLightsToStringArray(
                    $counter->getExistingFlights()
                )
            )
        );
        $statement->execute();
    }

    public function update(FlightsDestinationCounter $counter): void
    {
        $sql = 'UPDATE flights_destination_counter SET destination=:destination, total=:total, existing_flights=:existing_flights WHERE id=:id';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $counter->getId()->value());
        $statement->bindValue(':destination', $counter->getFlightDestination());
        $statement->bindValue(':total', $counter->getTotal()->value());
        $statement->bindValue(
            ':existing_flights',
            json_encode(
                FlightsDestinationCounter::convertExistingFLightsToStringArray(
                    $counter->getExistingFlights()
                )
            )
        );
        $statement->execute();
    }

    public function search(string $flightDestination): ?FlightsDestinationCounter
    {
        $sql = 'SELECT * FROM flights_destination_counter WHERE destination = :destination LIMIT 1';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':destination', $flightDestination);
        $statement->execute();
        $flightsDestinationCounterSelect = $statement->fetchAll();
        if (empty($flightsDestinationCounterSelect)) {
            return null;
        }
        $flightsDestinationCounter = $flightsDestinationCounterSelect[0];
        $jsonExistingFlights = json_decode($flightsDestinationCounter["existing_flights"], true);
        $existingFlights = [];
        for ($i = 0; $i < count($jsonExistingFlights); $i++) {
            $existingFlights[] = new Uuid($jsonExistingFlights[$i]);
        }

        return new FlightsDestinationCounter(
            new Uuid($flightsDestinationCounter["id"]),
            $flightsDestinationCounter["destination"],
            FlightsDestinationCounterTotal::newFlightsDestinationCounterTotal(
                intval($flightsDestinationCounter["total"])
            ),
            $existingFlights
        );
    }
}