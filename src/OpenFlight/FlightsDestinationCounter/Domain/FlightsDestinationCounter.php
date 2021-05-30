<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Domain;


use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class FlightsDestinationCounter extends AggregateRoot
{
    const initialCounterValue = 0;

    public function __construct(
        private Uuid $id,
        private string $flightDestination,
        private int $total,
        private array $existingFlights
    ) {
    }

    public static function initialize(Uuid $id, string $destination): self
    {
        return new self($id, $destination, self::initialCounterValue, []);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getFlightDestination(): string
    {
        return $this->flightDestination;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getExistingFlights(): array
    {
        return $this->existingFlights;
    }

    public function hasIncremented(Uuid $flightId): bool
    {
        return in_array($flightId, $this->getExistingFlights());
    }

    public function increment(Uuid $flightId)
    {
        $this->total += 1;
        $this->existingFlights[] = $flightId;
        $this->record(
            new FlightsDestinationCounterIncrementedDomainEvent(
                $this->getId()->value(),
                $this->getFlightDestination(),
                $this->getTotal()
            )
        );
    }

    public static function convertExistingFLightsToStringArray(array $existingFlights): array
    {
        $stringArray = [];
        foreach ($existingFlights as $item) {
            $stringArray[] = $item->value();
        }

        return $stringArray;
    }

}