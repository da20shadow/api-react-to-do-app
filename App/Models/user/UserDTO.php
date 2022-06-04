<?php

namespace App\Models\user;

use Exception;

class UserDTO
{
    private int $id;
    private string $username;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;

    /**
     * @throws Exception
     */
    public static function create($username, $email, $password,
                                  $firstName = null, $lastName = null , $id = null): UserDTO
    {
        return (new UserDTO())
            ->setUsername($username)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setEmail($email)
            ->setPassword($password)
            ->setId($id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserDTO
     */
    public function setId(int $id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return UserDTO
     */
    public function setFirstName(string $firstName): UserDTO
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return UserDTO
     */
    public function setLastName(string $lastName): UserDTO
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return UserDTO
     * @throws Exception
     */
    public function setUsername(string $username): UserDTO
    {
        $username = trim($username);
        $username = htmlspecialchars($username);
        $username = stripcslashes($username);

        if (strlen($username) < 4){
            throw new Exception("Username must be at least 4 characters!");
        }else if (strlen($username) > 40){
            throw new Exception("Username is too long, max allowed 40 characters!");
        }else if (!preg_match("/^[a-zA-Z]+[a-zA-Z0-9_]{3,}$/",$username)){
            throw new Exception("Invalid chars in Username! Allowed a-Z 0-9 and '_' only!");
        }

        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserDTO
     */
    public function setEmail(string $email): UserDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserDTO
     */
    public function setPassword(string $password): UserDTO
    {
        $this->password = $password;
        return $this;
    }
}