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
        return $this->db->query(
            'SELECT id,
                username,
                email,
                password,
                first_name AS firstName,
                last_name AS lastName
                FROM users 
                WHERE username = :username'
        )->execute(array(
            ":username" => $username
        ))->fetch(UserDTO::class)
            ->current();
    }

    public function findUserByEmail(string $email): ?UserDTO
    {
        return $this->db->query(
            'SELECT id,
                username,
                email,
                password,
                first_name AS firstName,
                last_name AS lastName
                FROM users 
                WHERE email = :email'
        )->execute(array(
            ":email" => $email
        ))->fetch(UserDTO::class)
            ->current();
    }

    public function findUserById(int $id): ?UserDTO
    {
        return $this->db->query(
            'SELECT id,
                username,
                email,
                password,
                first_name AS firstName,
                last_name AS lastName
                FROM users 
                WHERE id = :id'
        )->execute(array(
            ":id" => $id
        ))->fetch(UserDTO::class)
            ->current();
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