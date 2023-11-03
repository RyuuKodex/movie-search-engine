<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\SearchEngineStrategyProviderInterface;

final readonly class FindMoviesQuery
{
    public function __construct(private SearchEngineStrategyProviderInterface $searchEngineStrategyProvider)
    {
    }

    /** @return Movie[] */
    public function findMatchingByAlgorithm(MovieSearchAlgorithm $algorithm): array
    {
        $strategy = $this->searchEngineStrategyProvider->getStrategy($algorithm);

        return array_values($strategy->find());
    }
}
