<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Application\Create;

use CodelyTv\OpenFlight\Books\Domain\Luggage;
use CodelyTv\OpenFlight\Books\Domain\SeatValueObject;
use CodelyTv\OpenFlight\Books\Domain\WeightValueObject;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class CreateBookCommandHandler implements CommandHandler
{

    private BookCreation $bookCreation;

    public function __construct(BookCreation $bookCreation)
    {
        $this->bookCreation = $bookCreation;
    }

    public function __invoke(CreateBookCommand $command): void
    {
        $id = new Uuid($command->getId());


        $buyDate = DateTimeValueObject::createDateTimeValueObjectFromString($command->getBuyDate());
        $seat = SeatValueObject::createSeat(
            intval($command->getSeatNumber()),
            $command->getSeatLetter(),
            $command->getSeatClass()
        );
        $price = PriceValueObject::createPrice(intval($command->getPriceValue()), $command->getPriceCurrency());
        $luggage = Luggage::createLuggage(
            Uuid::random(),
            $command->getLuggageType(),
            WeightValueObject::createWeight(
                intval($command->getLuggageWeightNumber()),
                $command->getLuggageWeightUnit()
            ),
            new Uuid($command->getId())
        );

        $this->bookCreation->__invoke(
            $id,
            $buyDate,
            $seat,
            $price,
            $command->getFlightId(),
            $command->getUserId(),
            $luggage

        );
    }

}
