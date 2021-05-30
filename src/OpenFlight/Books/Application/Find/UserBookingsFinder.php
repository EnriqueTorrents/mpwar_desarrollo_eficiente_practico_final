<?php


namespace CodelyTv\OpenFlight\Books\Application\Find;


use CodelyTv\OpenFlight\Books\Domain\Book;
use CodelyTv\OpenFlight\Books\Domain\BookRepository;
use CodelyTv\OpenFlight\Flights\Application\FindFlightResponse;
use CodelyTv\OpenFlight\Flights\Domain\FlightRepository;
use CodelyTv\OpenFlight\Users\Domain\UserNotExist;
use CodelyTv\OpenFlight\Users\Domain\UserRepository;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class UserBookingsFinder
{
    public function __construct(
        private BookRepository $bookRepository,
        private UserRepository $userRepository,
        private FlightRepository $flightRepository
    ) {
    }

    public function __invoke(Uuid $userId): FindUserBookingsResponse
    {
        $user = $this->userRepository->search($userId);

        if (empty($user)) {
            throw new UserNotExist();
        }

        $bookings = $this->bookRepository->findByUserId($userId);

        /** @var Book $book */
        $bookingsResponse = [];
        foreach ($bookings as $book) {
            $flight = $this->flightRepository->search(new Uuid($book->getFlightId()));

            $bookingsResponse[] = new FindUserBookResponse(
                DateTimeValueObject::convertDateTimeToString($book->getBuyDate()),
                $book->getSeat()->getNumber(),
                $book->getSeat()->getLetter(),
                $book->getSeat()->getClass(),
                $book->getPrice()->getValue(),
                $book->getPrice()->getCurrency(),
                new FindFlightResponse(
                    $flight->getOrigin(),
                    $flight->getDestination(),
                    $flight->getFlightHours(),
                    DateTimeValueObject::convertDateTimeToString($flight->getDepartureDate()),
                    $flight->getAircraft(),
                    $flight->getAirline()
                )
            );
        }
        return new FindUserBookingsResponse($user->Username(), $bookingsResponse);
    }
}