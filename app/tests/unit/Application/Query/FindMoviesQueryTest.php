<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\Query;

use App\Application\Query\FindMoviesQuery;
use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\SearchEngineStrategyProviderInterface;
use App\Domain\SearchEngine\Strategy\SearchEngineStrategyInterface;
use PHPUnit\Framework\TestCase;

final class FindMoviesQueryTest extends TestCase
{
    public function testFindMatchingByAlgorithm(): void
    {
        $strategyProviderMock = $this->createMock(SearchEngineStrategyProviderInterface::class);
        $strategyMock = $this->createMock(SearchEngineStrategyInterface::class);

        $strategyProviderMock->expects(self::once())
            ->method('getStrategy')
            ->willReturn($strategyMock)
        ;

        $movie = new Movie('Django');
        $strategyMock->expects(self::once())
            ->method('find')
            ->willReturn([$movie])
        ;

        $query = new FindMoviesQuery($strategyProviderMock);

        $movies = $query->findMatchingByAlgorithm(MovieSearchAlgorithm::RANDOM);

        $this->assertIsArray($movies);
        $this->assertSame($movie->getName(), $movies[0]->getName());
        $this->assertInstanceOf(Movie::class, $movies[0]);
    }
}
