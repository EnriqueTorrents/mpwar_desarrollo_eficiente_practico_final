<?php


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Books;


use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

class FindUserBookingsGetController extends ApiController
{
    public function __invoke(string $userId)
    {
        $response = $this->ask();

        return new JsonResponse();
    }

    protected function exceptions(): array
    {
        return [];
    }


}