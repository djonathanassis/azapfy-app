<?php

namespace App\Interfaces;

interface InvoiceInterface
{
    public function findAll();

    public function findOne(int $id): mixed;

    public function create(array $data): mixed;

    public function update(array $data, int $id): mixed;

    public function delete(int $id): bool;
}
