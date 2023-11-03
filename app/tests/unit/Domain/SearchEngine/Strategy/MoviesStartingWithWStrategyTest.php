<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\SearchEngine\Strategy;

use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\Strategy\MoviesStartingWithWStrategy;
use App\Infrastructure\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;

final class MoviesStartingWithWStrategyTest extends TestCase
{
    public function testSupports(): void
    {
        $strategy = new MoviesStartingWithWStrategy($this->createMock(MovieRepository::class));

        self::assertTrue($strategy->supports(MovieSearchAlgorithm::STARTS_WITH_W));
    }

    public function testDoesntSupports(): void
    {
        $strategy = new MoviesStartingWithWStrategy($this->createMock(MovieRepository::class));

        self::assertFalse($strategy->supports(MovieSearchAlgorithm::RANDOM));
    }

    public function testFind(): void
    {
        $repositoryMock = $this->createMock(MovieRepository::class);
        $strategy = new MoviesStartingWithWStrategy($repositoryMock);

        $repositoryMock->expects(self::once())
            ->method('getAll')
            ->willReturn(
                [
                    new Movie('WMovieEven'),
                    new Movie('WMovieOdd'),
                    new Movie('Movie3'),
                    new Movie('Movie4'),
                ]
            )
        ;

        $movies = $strategy->find();

        $this->assertCount(1, $movies);
        $this->assertEquals(new Movie('WMovieEven'), $movies[0]);
    }
}
