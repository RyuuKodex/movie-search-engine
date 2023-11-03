<?php

declare(strict_types=1);

namespace App\Domain\SearchEngine;

use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\Exception\SearchEngineStrategyNotFoundException;
use App\Domain\SearchEngine\Strategy\SearchEngineStrategyInterface;

final readonly class SearchEngineStrategyProvider implements SearchEngineStrategyProviderInterface
{
    /** @param SearchEngineStrategyInterface[] $strategies */
    public function __construct(private iterable $strategies)
    {
    }

    public function getStrategy(MovieSearchAlgorithm $algorithm): SearchEngineStrategyInterface
    {
        foreach ($this->strategies as $strategy) {
            if (!$strategy->supports($algorithm)) {
                continue;
            }

            return $strategy;
        }

        throw SearchEngineStrategyNotFoundException::fromAlgorithm($algorithm);
    }
}
