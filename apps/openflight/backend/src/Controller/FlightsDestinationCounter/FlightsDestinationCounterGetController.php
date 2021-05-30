<?php


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\FlightsDestinationCounter;


use CodelyTv\OpenFlight\FlightsDestinationCounter\Application\Find\FindFlightsDestinationCounterQuery;
use CodelyTv\OpenFlight\FlightsDestinationCounter\Application\Find\FlightsDestinationCounterResponse;
use CodelyTv\OpenFlight\FlightsDestinationCounter\Domain\FlightsDestinationCounterNotExist;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FlightsDestinationCounterGetController extends ApiController
{
    public function __invoke(string $flightDestination): JsonResponse
    {
        /** @var FlightsDestinationCounterResponse $response */
        $response = $this->ask(
            new FindFlightsDestinationCounterQuery($flightDestination)

        );

        return new JsonResponse(
            [
                'flight-destination' => $response->getFlightDestination(),
                'total' => $response->getTotal(),
            ]
        );
    }

    protected function exceptions(): array
    {
        return [
            FlightsDestinationCounterNotExist::class => Response::HTTP_NOT_FOUND,
        ];
    }
}