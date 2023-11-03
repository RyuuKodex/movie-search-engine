<?php

declare(strict_types=1);

namespace App\Domain\SearchEngine\Strategy;

use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;
use App\Infrastructure\Repository\MovieRepository;

final readonly class RandomMoviesStrategy implements SearchEngineStrategyInterface
{
    public function __construct(private MovieRepository $movieRepository)
    {
    }

    public function supports(MovieSearchAlgorithm $algorithm): bool
    {
        return MovieSearchAlgorithm::RANDOM === $algorithm;
    }

    /** @return Movie[] */
    public function find(): array
    {
        $movies = $this->movieRepository->getAll();

        shuffle($movies);

        return array_slice($movies, 0, 3);
    }
}
