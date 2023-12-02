<?php

namespace App\Interfaces;

interface BaseMethodInterface
{
    public function findAll();

    public function findOne(int $id): mixed;

    public function create(MethodDtoInterface $dto): void;

    public function update(MethodDtoInterface $dto, int $id): mixed;

    public function delete(int $id): void;
}
