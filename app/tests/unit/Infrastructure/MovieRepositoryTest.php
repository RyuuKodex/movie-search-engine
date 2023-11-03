<?php

declare(strict_types=1);

namespace App\Tests\unit\Infrastructure;

use App\Infrastructure\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;

final class MovieRepositoryTest extends TestCase
{
    public function testGetAll(): void
    {
        $repository = new MovieRepository('/app/data/movies.php');

        $movies = $repository->getAll();

        $this->assertCount(85, $movies);
    }
}
