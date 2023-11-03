<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Movie;

class MovieRepository
{
    /** @var Movie[] */
    private array $movies;

    public function __construct(string $sourceFilePath)
    {
        $moviesNames = include $sourceFilePath;

        foreach ($moviesNames as $movieName) {
            $movie = new Movie($movieName);
            $this->movies[] = $movie;
        }
    }

    /** @return Movie[] */
    public function getAll(): array
    {
        return $this->movies;
    }
}
