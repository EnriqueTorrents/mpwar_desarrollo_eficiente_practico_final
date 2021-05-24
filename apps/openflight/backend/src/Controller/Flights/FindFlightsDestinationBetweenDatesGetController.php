<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Flights;


use CodelyTv\OpenFlight\Flights\Application\Find\FindFlightsDestinationBetweenDatesQuery;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class FindFlightsDestinationBetweenDatesGetController extends ApiController
{

    public function __invoke(string $destination, string $dateFrom, string $dateTo): JsonResponse
    {
        $response = $this->ask(
            new FindFlightsDestinationBetweenDatesQuery(
                $destination,
                $dateFrom,
                $dateTo
            )
        );

        $flightsResponse = [];
        foreach ($response->getFlights() as $flightResponse) {
            array_push(
                $flightsResponse,
                [
                    'origin' => $flightResponse->getOrigin(),
                    'destination' => $flightResponse->getDestination(),
                    'flight-hours' => $flightResponse->getFlightHours(),
                    'price-value' => $flightResponse->getPriceValue(),
                    'price-currency' => $flightResponse->getPriceCurrency(),
                    'departure-date' => $flightResponse->getDepartureDate(),
                    'aircraft' => $flightResponse->getAircraft(),
                    'airline' => $flightResponse->getAirline(),
                ]
            );
        }

        if (empty($flightsResponse)) {
            $flightsResponse = "0 Results";
        }

        return new JsonResponse(
            [
                'destination' => $destination,
                'date-from' => $dateFrom,
                'date-to' => $dateTo,
                'flights' => $flightsResponse,
            ],
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [];
    }

}