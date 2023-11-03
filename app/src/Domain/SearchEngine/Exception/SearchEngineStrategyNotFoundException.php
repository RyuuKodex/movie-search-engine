<?php

declare(strict_types=1);

namespace App\Domain\SearchEngine\Exception;

use App\Domain\MovieSearchAlgorithm;

final class SearchEngineStrategyNotFoundException extends \RuntimeException
{
    public static function fromAlgorithm(MovieSearchAlgorithm $algorithm): self
    {
        return new self(sprintf('No strategy for algorithm `%s` found.', $algorithm->value));
    }
}
