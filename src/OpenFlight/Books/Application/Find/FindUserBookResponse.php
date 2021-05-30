<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

class FindUserBookResponse implements Response
{
    public function __construct(private string $userId, private string $flightId)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getFlightId(): string
    {
        return $this->flightId;
    }

}