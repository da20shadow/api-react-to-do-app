<?php

namespace App\Services\encryption;

interface EncryptionInterface
{
    public function hash(string $password);
    public function verify(string $password, string $hash);
}