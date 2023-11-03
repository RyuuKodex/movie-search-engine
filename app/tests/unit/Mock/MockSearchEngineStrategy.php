<?php

declare(strict_types=1);

namespace App\Tests\unit\Mock;

use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\Strategy\SearchEngineStrategyInterface;

readonly class MockSearchEngineStrategy implements SearchEngineStrategyInterface
{
    /**  @param Movie[] $result */
    public function __construct(private bool $isSupporting, private array $result)
    {
    }

    public function supports(MovieSearchAlgorithm $algorithm): bool
    {
        return $this->isSupporting;
    }

    /**  @return Movie[] */
    public function find(): array
    {
        return $this->result;
    }
}
