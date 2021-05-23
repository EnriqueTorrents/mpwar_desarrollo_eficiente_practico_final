<?php


namespace CodelyTv\OpenFlight\Flights\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

class FindFlightResponse implements Response
{
    private string $origin;
    private string $destination;
    private int $flightHours;
    private int $priceValue;
    private string $priceCurrency;
    private string $departureDate;
    private string $aircraft;
    private string $airline;

    public function __construct(
        string $origin,
        string $destination,
        int $flightHours,
        int $priceValue,
        string $priceCurrency,
        string $departureDate,
        string $aircraft,
        string $airline
    ) {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->flightHours = $flightHours;
        $this->priceValue = $priceValue;
        $this->priceCurrency = $priceCurrency;
        $this->departureDate = $departureDate;
        $this->aircraft = $aircraft;
        $this->airline = $airline;
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getFlightHours(): int
    {
        return $this->flightHours;
    }

    public function getPriceValue(): int
    {
        return $this->priceValue;
    }

    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }

    public function getDepartureDate(): string
    {
        return $this->departureDate;
    }

    public function getAircraft(): string
    {
        return $this->aircraft;
    }

    public function getAirline(): string
    {
        return $this->airline;
    }


}