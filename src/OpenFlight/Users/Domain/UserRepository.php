<?php


namespace CodelyTv\OpenFlight\Users\Domain;

use CodelyTv\Shared\Domain\ValueObject\Uuid;

interface UserRepository
{
    public function Save(User $user): void;

    public function findByUsername(string $username): User;

    public function search(Uuid $userId): ?User;
}