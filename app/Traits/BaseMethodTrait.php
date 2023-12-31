<?php

declare(strict_types=1);

namespace App\Traits;

use App\Interfaces\MethodDtoInterface;
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

    public function create(MethodDtoInterface|array $dto): void
    {
        is_array($dto)
            ? $this->model->create($dto)
            : $this->model->create($dto->toArray());
    }

    public function update(MethodDtoInterface|array $dto, int $id): mixed
    {
        $model = $this->model->findOrFail($id);

        is_array($dto)
            ? $model->update($dto)
            : $model->update($dto->toArray());

        return $model;
    }

    public function delete(int $id): void
    {
       $this->model->findOrFail($id)->delete();
    }

}
