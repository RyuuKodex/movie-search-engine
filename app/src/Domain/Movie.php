<?php

declare(strict_types=1);

namespace App\Domain;

final readonly class Movie
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
