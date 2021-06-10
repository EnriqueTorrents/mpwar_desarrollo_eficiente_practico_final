<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Flights;


use CodelyTv\OpenFlight\Flights\Application\Create\CreateFlightCommand;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateFlightPostController extends ApiController
{

    public function __invoke(string $id, Request $request): JsonResponse
    {
        $this->dispatch(
            new CreateFlightCommand(
                $id,
                $request->request->getAlpha('origin'),
                $request->request->getAlpha('destination'),
                intval($request->request->get('flight-hours')),
                intval($request->request->get('price')),
                $request->request->get('currency'),
                $request->request->get('departure-date'),
                $request->request->getAlpha('aircraft'),
                $request->request->getAlpha('airline')
            )
        );
        return new JsonResponse("OK", Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [];
    }

}