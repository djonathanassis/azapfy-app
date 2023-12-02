<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Interfaces\MethodDtoInterface;
use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractDto implements Arrayable, MethodDtoInterface
{
    public function toArray(): array
    {
      return $this->all();
    }

    protected function all(): array
    {
        return get_object_vars($this);
    }
}
