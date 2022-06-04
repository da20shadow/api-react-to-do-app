<?php

namespace App\Services\user;

use App\Models\user\UserDTO;
use App\Repositories\user\UserRepositoryInterface;
use App\Services\encryption\EncryptionInterface;
use Generator;

class UserService implements UserServiceInterface
{

    private UserRepositoryInterface $userRepository;
    private EncryptionInterface $encryptionService;

    public function __construct($userRepository,$encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }

    public function register(UserDTO $userDTO, string $confirmPassword): string
    {
        if ($userDTO->getPassword() !== $confirmPassword){
            return "Error! Passwords doesn't match!";
        }

        if (null !== $this->userRepository->findUserByUsername($userDTO->getUsername())){
            return "Error! This Username Already Registered!";
        }

        if (null !== $this->userRepository->findUserByEmail($userDTO->getEmail())){
            return "Error! This Email Already Registered!";
        }

        $this->encryptPassword($userDTO);

        return $this->userRepository->insert($userDTO);
    }

    private function encryptPassword(UserDTO $userDTO)
    {
        $plainPassword = $userDTO->getPassword();
        $passwordHash = $this->encryptionService->hash($plainPassword);
        $userDTO->setPassword($passwordHash);
    }

    public function login(string $username, string $password): ?UserDTO
    {
        $userFormDB = $this->userRepository->findUserByUsername($username);

        if (null === $userFormDB){
            return null;
        }
        if (false === $this->encryptionService->verify($password,$userFormDB->getPassword())){
            return null;
        }
        return $userFormDB;
    }

    public function currentUser(): ?UserDTO
    {
        // TODO: Implement currentUser() method.
    }

    public function isLogged(): bool
    {
        // TODO: Implement isLogged() method.
    }

    public function edit(UserDTO $userDTO): bool
    {
        // TODO: Implement edit() method.
    }

    public function getAll(): array|Generator
    {
        return $this->userRepository->getAll();
    }
}