<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\SearchEngine\Strategy;

use App\Domain\Movie;
use App\Domain\MovieSearchAlgorithm;
use App\Domain\SearchEngine\Strategy\MoviesContainingMoreThanOneWordStrategy;
use App\Infrastructure\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;

final class MoviesContainingMoreThanOneWordStrategyTest extends TestCase
{
    public function testSupports(): void
    {
        $strategy = new MoviesContainingMoreThanOneWordStrategy($this->createMock(MovieRepository::class));

        self::assertTrue($strategy->supports(MovieSearchAlgorithm::MORE_THAN_ONE_WORD));
    }

    public function testDoesntSupports(): void
    {
        $strategy = new MoviesContainingMoreThanOneWordStrategy($this->createMock(MovieRepository::class));

        self::assertFalse($strategy->supports(MovieSearchAlgorithm::RANDOM));
    }

    public function testFind(): void
    {
        $repositoryMock = $this->createMock(MovieRepository::class);
        $strategy = new MoviesContainingMoreThanOneWordStrategy($repositoryMock);

        $repositoryMock->expects(self::once())
            ->method('getAll')
            ->willReturn(
                [
                    new Movie('Movie With Four Words'),
                    new Movie('Movie Three Words'),
                    new Movie('Movie Words'),
                    new Movie('Movie2'),
                ]
            )
        ;

        $movies = $strategy->find();

        $this->assertCount(3, $movies);
        $this->assertEquals(new Movie('Movie With Four Words'), $movies[0]);
        $this->assertEquals(new Movie('Movie Three Words'), $movies[1]);
        $this->assertEquals(new Movie('Movie Words'), $movies[2]);
    }
}
