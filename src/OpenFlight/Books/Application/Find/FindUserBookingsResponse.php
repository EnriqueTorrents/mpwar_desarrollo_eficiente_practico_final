<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

class FindUserBookingsResponse implements Response
{
    public function __construct(private string $username, private array $bookings)
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getBookings(): array
    {
        return $this->bookings;
    }

}