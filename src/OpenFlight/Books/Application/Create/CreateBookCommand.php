<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class CreateBookCommand implements Command
{

    private string $id;
    private string $buyDate;
    private int $seatNumber;
    private string $seatLetter;
    private string $seatClass;
    private int $priceValue;
    private string $priceCurrency;
    private string $flightId;
    private string $userId;
    private string $luggageType;
    private int $luggageWeightNumber;
    private string $luggageWeightUnit;


    public function __construct(
        string $id,
        string $buyDate,
        int $seatNumber,
        string $seatLetter,
        string $seatClass,
        int $priceValue,
        string $priceCurrency,
        string $flightId,
        string $userId,
        string $luggageType,
        int $luggageWeightNumber,
        string $luggageWeightUnit
    ) {
        $this->id = $id;
        $this->buyDate = $buyDate;
        $this->seatNumber = $seatNumber;
        $this->seatLetter = $seatLetter;
        $this->seatClass = $seatClass;
        $this->priceValue = $priceValue;
        $this->priceCurrency = $priceCurrency;
        $this->flightId = $flightId;
        $this->userId = $userId;
        $this->luggageType = $luggageType;
        $this->luggageWeightNumber = $luggageWeightNumber;
        $this->luggageWeightUnit = $luggageWeightUnit;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBuyDate(): string
    {
        return $this->buyDate;
    }

    public function getSeatNumber(): int
    {
        return $this->seatNumber;
    }

    public function getSeatLetter(): string
    {
        return $this->seatLetter;
    }

    public function getSeatClass(): string
    {
        return $this->seatClass;
    }

    public function getPriceValue(): int
    {
        return $this->priceValue;
    }

    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }

    public function getFlightId(): string
    {
        return $this->flightId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getLuggageType(): string
    {
        return $this->luggageType;
    }

    public function getLuggageWeightNumber(): int
    {
        return $this->luggageWeightNumber;
    }

    public function getLuggageWeightUnit(): string
    {
        return $this->luggageWeightUnit;
    }


}
