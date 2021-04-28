<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class Flight extends AggregateRoot
{
    private Uuid $id;
    private string $origin;
    private string $destination;
    private int $flightHours;
    private int $price;
    private string $currency;
    private DateTime $departureDate;
    private string $aircraft;
    private string $airline;

    /**
     * Flight constructor.
     * @param Uuid $id
     * @param string $origin
     * @param string $destination
     * @param int $flightHours
     * @param int $price
     * @param string $currency
     * @param DateTime $departureDate
     * @param string $aircraft
     * @param string $airline
     */
    public function __construct(
        Uuid $id,
        string $origin,
        string $destination,
        int $flightHours,
        int $price,
        string $currency,
        DateTime $departureDate,
        string $aircraft,
        string $airline
    ) {
        $this->id = $id;
        $this->origin = $origin;
        $this->destination = $destination;
        $this->flightHours = $flightHours;
        $this->price = $price;
        $this->currency = $currency;
        $this->departureDate = $departureDate;
        $this->aircraft = $aircraft;
        $this->airline = $airline;
    }

    public static function CreateFlight(
        Uuid $id,
        string $origin,
        string $destination,
        int $flightHours,
        int $price,
        string $currency,
        DateTime $departureDate,
        string $aircraft,
        string $airline
    ): Flight {
        return new self($id, $origin, $destination, $flightHours, $price, $destination, $departureDate, $destination, $currency, $departureDate, $aircraft, $airline);
    }

    private static function validateOrigin(string $origin): void{
        if( $origin === ""){
            throw new EmptyOrigin();
        }
    }

    private static function validateDestination(string $destination): void{
        if( $destination === ""){
            throw new EmptyDestination();
        }
    }

    private static function validateFlightHours(int $flightHours): void{
        if( $flightHours < 1){
            throw new InvalidFlightHours();
        }
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @return int
     */
    public function getFlightHours(): int
    {
        return $this->flightHours;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return DateTime
     */
    public function getDepartureDate(): DateTime
    {
        return $this->departureDate;
    }

    /**
     * @return string
     */
    public function getAircraft(): string
    {
        return $this->aircraft;
    }

    /**
     * @return string
     */
    public function getAirline(): string
    {
        return $this->airline;
    }

}