<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Domain;


use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class FlightsDestinationCounterIncrementedDomainEvent extends DomainEvent
{
    public function __construct(
        string $aggregateId,
        private string $destination,
        private int $total,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self(new Uuid($aggregateId), $body['destination'], $body['total'], $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return "open_flight.v1.flightsDestinationCounter.incremented";
    }

    public function toPrimitives(): array
    {
        return [
            'destination' => $this->destination,
            'total' => $this->total,
        ];
    }
}