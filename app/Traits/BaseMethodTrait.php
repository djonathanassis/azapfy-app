<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait BaseMethodTrait
{
    public function findAll(): Collection
    {
        return $this->model->all();
    }

    public function findOne(int $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): mixed
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

}
