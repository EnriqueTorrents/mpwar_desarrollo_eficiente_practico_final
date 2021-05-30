<?php


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Books;


use CodelyTv\OpenFlight\Books\Application\Find\FindUserBookingsQuery;
use CodelyTv\OpenFlight\Books\Application\Find\FindUserBookingsResponse;
use CodelyTv\OpenFlight\Books\Application\Find\FindUserBookResponse;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindUserBookingsGetController extends ApiController
{
    public function __invoke(string $userId)
    {
        /** @var FindUserBookingsResponse $response */
        $response = $this->ask(new FindUserBookingsQuery($userId));

        $userBookingsResponse = [];
        /** @var FindUserBookResponse $book */
        foreach ($response->getBookings() as $book) {
            array_push(
                $userBookingsResponse,
                [
                    'flight-id' => $book->getFlightId(),
                ]
            );
        }

        return new JsonResponse(
            [
                'user-id' => $response->getUserId(),
                'bookings' => $userBookingsResponse,
            ],
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [];
    }


}