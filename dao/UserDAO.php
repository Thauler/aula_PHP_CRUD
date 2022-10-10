<?php

interface UserDAO
{
    public function create(User $user): User;

    public function findAll(): array;

    public function findById(int $id): User;

    public function findByEmail(string $email); // can't use union type on PHP 7.4 just on PHP 8.

    public function update(User $user): void;

    public function delete(int $id): void;
}