<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

class FindUserBookLuggageResponse implements Response
{

    public function __construct(private string $type, private int $weightNumber, private string $weightUnit)
    {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getWeightNumber(): int
    {
        return $this->weightNumber;
    }

    public function getWeightUnit(): string
    {
        return $this->weightUnit;
    }

}