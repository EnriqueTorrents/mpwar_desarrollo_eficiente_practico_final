<?php


namespace CodelyTv\OpenFlight\Flights\Application\Create;


use CodelyTv\OpenFlight\Flights\Domain\Flight;
use CodelyTv\OpenFlight\Flights\Domain\FlightRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;


class FlightCreation
{

    public function __construct(private FlightRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(
        Uuid $id,
        string $origin,
        string $destination,
        int $flightHours,
        PriceValueObject $price,
        DateTimeValueObject $departureDate,
        string $aircraft,
        string $airline
    ): void {

        $flight = Flight::CreateFlight(
            $id,
            $origin,
            $destination,
            $flightHours,
            $price,
            $departureDate,
            $aircraft,
            $airline
        );
        $this->repository->create($flight);
        $this->bus->publish(...$flight->pullDomainEvents());
    }

}