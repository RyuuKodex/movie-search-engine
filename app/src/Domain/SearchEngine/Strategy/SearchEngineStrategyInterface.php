<?php

declare(strict_types=1);

namespace App\Domain\SearchEngine\Strategy;

use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;

interface SearchEngineStrategyInterface
{
    public function supports(MovieSearchAlgorithm $algorithm): bool;

    /** @return Movie[] */
    public function find(): array;
}
