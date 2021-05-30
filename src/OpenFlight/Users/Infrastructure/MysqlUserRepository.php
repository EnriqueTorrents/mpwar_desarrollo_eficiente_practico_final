<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Users\Infrastructure;


use CodelyTv\OpenFlight\Users\Domain\IncorrectUserName;
use CodelyTv\OpenFlight\Users\Domain\User;
use CodelyTv\OpenFlight\Users\Domain\UserRepository;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;
use CodelyTv\Shared\Domain\ValueObject\Uuid;


final class MysqlUserRepository implements UserRepository
{
    public function __construct(private Mysql $mysql)
    {
    }

    public function Save(User $user): void
    {
        $sql = 'INSERT IGNORE INTO user VALUES(:id, :username, :name,:last_name, :password)';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $user->ID()->value());
        $statement->bindValue(':username', $user->Username());
        $statement->bindValue(':name', $user->Name());
        $statement->bindValue(':last_name', $user->LastName());
        $statement->bindValue(':password', $user->Password());
        $statement->execute();
    }

    public function findByUsername(string $username): User
    {
        $sql = 'SELECT * FROM user WHERE username = :username LIMIT 1';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $userArr = $statement->fetchAll();

        if (empty($userArr)) {
            throw new IncorrectUserName();
        }

        $user = $userArr[0];
        $uuid = new Uuid($user["Id"]);
        return new User($uuid, $user["Username"], $user["Name"], $user["LastName"], $user["Password"]);
    }

    public function search(Uuid $userId): ?User
    {
        $sql = 'SELECT * FROM user WHERE Id = :id LIMIT 1';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $userId->value());
        $statement->execute();
        $userArr = $statement->fetchAll();

        if (empty($userArr)) {
            return null;
        }

        $user = $userArr[0];
        $uuid = new Uuid($user["Id"]);
        return new User($uuid, $user["Username"], $user["Name"], $user["LastName"], $user["Password"]);
    }
}