<?php


namespace CodelyTv\OpenFlight\FlightsDestinationCounter\Domain;


use CodelyTv\Shared\Domain\ValueObject\IntValueObject;

final class FlightsDestinationCounterTotal extends IntValueObject
{
    const initialCounterValue = 0;
    const incrementCounterValue = 1;

    public static function initialize(): self
    {
        return new self(self::initialCounterValue);
    }

    public static function newFlightsDestinationCounterTotal(int $value): self
    {
        return new self($value);
    }

    public function increment(): self
    {
        return new self($this->value() + self::incrementCounterValue);
    }

}