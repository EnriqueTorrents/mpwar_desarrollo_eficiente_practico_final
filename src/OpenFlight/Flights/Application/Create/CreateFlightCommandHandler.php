<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class CreateFlightCommandHandler implements CommandHandler
{

    private FlightCreation $flightCreation;

    public function __construct(FlightCreation $flightCreation)
    {
        $this->flightCreation = $flightCreation;
    }

    public function __invoke(CreateFlightCommand $command): void
    {
        $id = new Uuid($command->getId());
        $price = PriceValueObject::createPrice(intval($command->getPriceValue()), $command->getPriceCurrency());
        $departureDate = DateTimeValueObject::createDateTimeValueObjectFromString($command->getDepartureDate());

        $this->flightCreation->__invoke(
            $id,
            $command->getOrigin(),
            $command->getDestination(),
            $command->getFlightHours(),
            $price,
            $departureDate,
            $command->getAircraft(),
            $command->getAirline()
        );
    }

}
