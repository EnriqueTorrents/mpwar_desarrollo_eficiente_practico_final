<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidLuggageType extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_luggage_type';
    }

    protected function errorMessage(): string
    {
        return sprintf('The luggage type is incorrect.');
    }
}