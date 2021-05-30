<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\OpenFlight\Flights\Application\FindFlightResponse;
use CodelyTv\Shared\Domain\Bus\Query\Response;

class FindUserBookResponse implements Response
{
    public function __construct(
        private string $buyDate,
        private int $seatNumber,
        private string $seatLetter,
        private string $seatClass,
        private int $priceValue,
        private string $priceCurrency,
        private FindFlightResponse $flightResponse,
        private FindUserBookLuggageResponse $userBookLuggageResponse
    ) {
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

    public function getFlightResponse(): FindFlightResponse
    {
        return $this->flightResponse;
    }

    public function getUserBookLuggageResponse(): FindUserBookLuggageResponse
    {
        return $this->userBookLuggageResponse;
    }

}