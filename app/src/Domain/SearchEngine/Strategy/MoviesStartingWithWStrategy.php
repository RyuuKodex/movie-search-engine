<?php

declare(strict_types=1);

namespace App\Domain\SearchEngine\Strategy;

use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;
use App\Infrastructure\Repository\MovieRepository;

final readonly class MoviesStartingWithWStrategy implements SearchEngineStrategyInterface
{
    public function __construct(private MovieRepository $movieRepository)
    {
    }

    public function supports(MovieSearchAlgorithm $algorithm): bool
    {
        return MovieSearchAlgorithm::STARTS_WITH_W === $algorithm;
    }

    /** @return Movie[] */
    public function find(): array
    {
        $movies = $this->movieRepository->getAll();

        return array_filter($movies, function ($movie) {
            return str_starts_with($movie->getName(), 'W') && (0 == strlen($movie->getName()) % 2);
        });
    }
}
