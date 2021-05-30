<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Application\Increment;


use CodelyTv\OpenFlight\Flights\Domain\FlightCreatedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class IncrementFlightsDestinationCounterOnFlightCreated implements DomainEventSubscriber
{

    public function __construct(private FlightsDestinationCounterIncrementer $flightsDestinationIncrementer)
    {
    }

    public static function subscribedTo(): array
    {
        return [FlightCreatedDomainEvent::class];
    }

    public function __invoke(FlightCreatedDomainEvent $event)
    {
        $flightId = new Uuid($event->aggregateId());
        $flightDestination = $event->toPrimitives()['destination'];

        $this->flightsDestinationIncrementer->__invoke($flightId, $flightDestination);
    }
}