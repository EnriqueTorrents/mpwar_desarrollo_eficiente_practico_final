<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\OpenFlight\Books\Domain\Book;
use CodelyTv\OpenFlight\Books\Domain\BookRepository;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class UserBookingsFinder
{
    public function __construct(private BookRepository $repository)
    {
    }

    public function __invoke(Uuid $userId): FindUserBookingsResponse
    {
        $bookings = $this->repository->findByUserId($userId);

        /** @var Book $book */
        $bookingsResponse = [];
        foreach ($bookings as $book) {
            $bookingsResponse[] = new FindUserBookResponse($book->getUserId()->value(), $book->getFlightId()->value());
        }
        return new FindUserBookingsResponse($userId->value(), $bookingsResponse);
    }
}