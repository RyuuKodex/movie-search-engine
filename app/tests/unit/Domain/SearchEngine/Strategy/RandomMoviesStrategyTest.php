<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\SearchEngine\Strategy;

use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\Strategy\RandomMoviesStrategy;
use App\Infrastructure\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;

final class RandomMoviesStrategyTest extends TestCase
{
    public function testSupports(): void
    {
        $strategy = new RandomMoviesStrategy($this->createMock(MovieRepository::class));

        self::assertTrue($strategy->supports(MovieSearchAlgorithm::RANDOM));
    }

    public function testDoesntSupports(): void
    {
        $strategy = new RandomMoviesStrategy($this->createMock(MovieRepository::class));

        self::assertFalse($strategy->supports(MovieSearchAlgorithm::STARTS_WITH_W));
    }

    public function testFind(): void
    {
        $repositoryMock = $this->createMock(MovieRepository::class);
        $strategy = new RandomMoviesStrategy($repositoryMock);

        $repositoryMock->expects(self::once())
            ->method('getAll')
            ->willReturn(
                [
                    new Movie('Movie1'),
                    new Movie('Movie2'),
                    new Movie('Movie3'),
                    new Movie('Movie4'),
                ]
            )
        ;

        $movies = $strategy->find();

        $this->assertCount(3, $movies);
    }
}
