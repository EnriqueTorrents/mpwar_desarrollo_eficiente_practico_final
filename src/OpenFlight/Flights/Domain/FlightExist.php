<?php


namespace CodelyTv\OpenFlight\Flights\Domain;


use CodelyTv\Shared\Domain\DomainError;

class FlightExist extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'flight_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The flight already exists.');
    }
}