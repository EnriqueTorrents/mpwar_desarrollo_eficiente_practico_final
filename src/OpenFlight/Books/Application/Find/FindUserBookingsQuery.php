<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Query;

class FindUserBookingsQuery implements Query
{
    public function __construct(private string $userId)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

}