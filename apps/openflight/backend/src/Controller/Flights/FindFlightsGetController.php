<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Flights;


use CodelyTv\OpenFlight\Flights\Application\Find\FindFlightsQuery;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class FindFlightsGetController extends ApiController
{

    public function __invoke(string $dateFrom, string $dateTo): JsonResponse
    {
        $response = $this->ask(
            new FindFlightsQuery(
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