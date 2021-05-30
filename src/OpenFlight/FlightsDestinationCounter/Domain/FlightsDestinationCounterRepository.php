<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Domain;

interface FlightsDestinationCounterRepository
{
    public function create(FlightsDestinationCounter $counter): void;

    public function update(FlightsDestinationCounter $counter): void;

    public function search(string $flightDestination): ?FlightsDestinationCounter;
}