<?php

declare(strict_types=1);

namespace App\Domain\SearchEngine;

use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\Strategy\SearchEngineStrategyInterface;

interface SearchEngineStrategyProviderInterface
{
    public function getStrategy(MovieSearchAlgorithm $algorithm): SearchEngineStrategyInterface;
}
