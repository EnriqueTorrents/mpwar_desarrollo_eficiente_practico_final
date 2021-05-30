<?php


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Books;


use CodelyTv\OpenFlight\Books\Application\Find\FindUserBookingsQuery;
use CodelyTv\OpenFlight\Books\Application\Find\FindUserBookingsResponse;
use CodelyTv\OpenFlight\Books\Application\Find\FindUserBookResponse;
use CodelyTv\OpenFlight\Users\Domain\UserNotExist;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindUserBookingsGetController extends ApiController
{
    public function __invoke(string $userId): JsonResponse
    {
        /** @var FindUserBookingsResponse $response */
        $response = $this->ask(new FindUserBookingsQuery($userId));

        $userBookingsResponse = [];
        /** @var FindUserBookResponse $book */
        foreach ($response->getBookings() as $book) {
            array_push(
                $userBookingsResponse,
                [
                    'buy-date' => $book->getBuyDate(),
                    'seat-number' => $book->getSeatNumber(),
                    'seat-letter' => $book->getSeatLetter(),
                    'seat-class' => $book->getSeatClass(),
                    'price-value' => $book->getPriceValue(),
                    'price-currency' => $book->getPriceCurrency(),
                    'flight' => [
                        'origin' => $book->getFlightResponse()->getOrigin(),
                        'destination' => $book->getFlightResponse()->getDestination(),
                        'flight-hours' => $book->getFlightResponse()->getFlightHours(),
                        'departure-date' => $book->getFlightResponse()->getDepartureDate(),
                        'aircraft' => $book->getFlightResponse()->getAircraft(),
                        'airline' => $book->getFlightResponse()->getAirline()
                    ],
                    'luggage' => [
                        'type' => $book->getUserBookLuggageResponse()->getType(),
                        'weight-number' => $book->getUserBookLuggageResponse()->getWeightNumber(),
                        'weight-unit' => $book->getUserBookLuggageResponse()->getWeightUnit()
                    ]
                ]
            );
        }

        return new JsonResponse(
            [
                'username' => $response->getUsername(),
                'bookings' => $userBookingsResponse,
            ],
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [
            UserNotExist::class => Response::HTTP_NOT_FOUND
        ];
    }


}