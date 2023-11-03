<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\SearchEngine;

use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\Exception\SearchEngineStrategyNotFoundException;
use App\Domain\SearchEngine\SearchEngineStrategyProvider;
use App\Tests\unit\Mock\MockSearchEngineStrategy;
use PHPUnit\Framework\TestCase;

final class SearchEngineStrategyProviderTest extends TestCase
{
    public function testGetStrategy(): void
    {
        $strategy1 = new MockSearchEngineStrategy(false, []);
        $strategy2 = new MockSearchEngineStrategy(false, []);
        $strategy3 = new MockSearchEngineStrategy(true, []);

        $strategyProvider = new SearchEngineStrategyProvider([$strategy1, $strategy2, $strategy3]);
        $strategy = $strategyProvider->getStrategy(MovieSearchAlgorithm::RANDOM);
        self::assertSame($strategy, $strategy3);
    }

    public function testFailedToGetStrategy(): void
    {
        $this->expectException(SearchEngineStrategyNotFoundException::class);
        $this->expectExceptionMessage('No strategy for algorithm `random` found.');

        $strategy1 = new MockSearchEngineStrategy(false, []);
        $strategy2 = new MockSearchEngineStrategy(false, []);
        $strategy3 = new MockSearchEngineStrategy(false, []);

        $strategyProvider = new SearchEngineStrategyProvider([$strategy1, $strategy2, $strategy3]);
        $strategyProvider->getStrategy(MovieSearchAlgorithm::RANDOM);
    }
}
