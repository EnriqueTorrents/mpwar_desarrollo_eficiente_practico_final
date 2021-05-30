<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class FindUserBookingsQueryHandler implements QueryHandler
{
    public function __construct(private UserBookingsFinder $bookingsFinder)
    {
    }

    public function __invoke(FindUserBookingsQuery $query): FindUserBookingsResponse
    {
        $userId = new Uuid($query->getUserId());
        return $this->bookingsFinder->__invoke($userId);
    }
}