<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

class FindUserBookingsResponse implements Response
{
    public function __construct(private string $userId, private array $bookings)
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getBookings(): array
    {
        return $this->bookings;
    }

}