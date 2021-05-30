<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Application\Increment;


use CodelyTv\OpenFlight\FlightsDestinationCounter\Domain\FlightsDestinationCounter;
use CodelyTv\OpenFlight\FlightsDestinationCounter\Domain\FlightsDestinationCounterRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class FlightsDestinationCounterIncrementer
{
    public function __construct(private FlightsDestinationCounterRepository $repository, private EventBus $eventBus)
    {
    }

    public function __invoke(Uuid $flightId, string $flightDestination)
    {
        $flightDestinationCounter = $this->repository->search($flightDestination);
        $isNew = false;
        if (empty($flightDestinationCounter)) {
            $isNew = true;
            $flightDestinationCounter = $this->initializeCounter($flightDestination);
        }

        if (!$flightDestinationCounter->hasIncremented($flightId)) {
            $flightDestinationCounter->increment($flightId);

            if ($isNew) {
                $this->repository->create($flightDestinationCounter);
            } else {
                $this->repository->update($flightDestinationCounter);
            }

            $this->eventBus->publish(...$flightDestinationCounter->pullDomainEvents());
        }
    }

    private function initializeCounter(string $flightDestination): FlightsDestinationCounter
    {
        return FlightsDestinationCounter::initialize(Uuid::random(), $flightDestination);
    }
}