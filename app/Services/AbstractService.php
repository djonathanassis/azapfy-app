<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\BaseMethodInterface;
use App\Traits\BaseMethodTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\ForwardsCalls;

abstract class AbstractService implements BaseMethodInterface
{
    use ForwardsCalls, BaseMethodTrait;

    protected AbstractService|Model $model;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(mixed $model = null)
    {
        $this->model = $model ?? $this->resolveModel();
    }

    public function __call(string $name, mixed $arguments)
    {
        $result = $this->forwardCallTo($this->model, $name, $arguments);

        if ($result === $this->model) {
            return $this;
        }

        return $result;
    }

    public function __get(string $name)
    {
        return $this->model->{$name};
    }

    public function __set(string $name, mixed $value)
    {
        $this->model->{$name} = $value;
        return $this;
    }

    public function __isset(string $name)
    {
        return isset($this->model->{$name});
    }

    /**
     * @throws BindingResolutionException
     * @throws \Exception
     */
    final protected function resolveModel(): Model
    {
        $model = app()->make($this->model);

        if (!$model instanceof Model) {
            throw new \RuntimeException(
                "Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }
        return (new static)->$model;
    }
}
