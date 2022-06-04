<?php

namespace App\Repositories\user;

use App\Models\user\UserDTO;
use Database\PDODatabase;
use Generator;
use PDOException;

class UserRepository implements UserRepositoryInterface
{

    private PDODatabase $db;

    public function __construct(PDODatabase $db)
    {
        $this->db = $db;
    }

    public function insert(UserDTO $userDTO): string
    {
        try {
            $this->db->query(
                "INSERT INTO users (username,email,password,first_name,last_name)
                            VALUES (:username,:email,:password,:first_name,:last_name)"
            )->execute(
                array(
                    ":username" => $userDTO->getUsername(),
                    ":email" => $userDTO->getEmail(),
                    ":password" => $userDTO->getPassword(),
                    ":first_name" => $userDTO->getFirstName(),
                    ":last_name" => $userDTO->getLastName()
                )
            );
            return "Successfully Registered!";
        }catch (PDOException $exception){
            return "Error Occur! " . $exception->getMessage();
        }
    }

    public function update(int $id, UserDTO $userDTO): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function findUserByUsername(string $username): ?UserDTO
    {
        // TODO: Implement findUserByUsername() method.
    }

    public function findUserByEmail(string $email): ?UserDTO
    {
        // TODO: Implement findUserByEmail() method.
    }

    public function findUserById(int $id): ?UserDTO
    {
        // TODO: Implement findUserById() method.
    }

    public function getAll(): array|Generator
    {
        return $this->db->query(
            "SELECT id, 
                    username,
                    email,
                    password,
                    first_name AS firstName,
                    last_name AS lastName
                    FROM users"
        )->execute()
            ->fetch(UserDTO::class);
    }
}