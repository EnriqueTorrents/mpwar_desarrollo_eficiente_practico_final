<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Domain;


use CodelyTv\Shared\Domain\DomainError;

class FlightsDestinationCounterNotExist extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'flight_destination_counter_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The destination provided does not have any flight created.');
    }
}