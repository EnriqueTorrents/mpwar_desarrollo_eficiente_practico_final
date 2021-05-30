<?php


namespace CodelyTv\OpenFlight\Books\Application\Create;


use CodelyTv\OpenFlight\Books\Domain\Book;
use CodelyTv\OpenFlight\Books\Domain\BookRepository;
use CodelyTv\OpenFlight\Books\Domain\Luggage;
use CodelyTv\OpenFlight\Books\Domain\SeatValueObject;
use CodelyTv\OpenFlight\Books\Domain\WeightValueObject;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;


class BookCreation
{

    public function __construct(private BookRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(
        Uuid $id,
        DateTimeValueObject $buyDate,
        SeatValueObject $seat,
        PriceValueObject $price,
        string $flightId,
        string $userId,
        Luggage $luggage
    ): void {
        $bookUuId = new Uuid($id);
        $flightUuId = new Uuid($flightId);
        $userUuId = new Uuid($userId);

        $book = Book::CreateBook(
            $bookUuId,
            $buyDate,
            $seat,
            $price,
            $flightUuId,
            $userUuId,
            $luggage
        );

        $this->repository->save($book);
        $this->bus->publish(...$book->pullDomainEvents());
    }

}