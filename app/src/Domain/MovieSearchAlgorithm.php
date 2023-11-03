<?php

declare(strict_types=1);

namespace App\Domain;

enum MovieSearchAlgorithm: string
{
    case RANDOM = 'random';
    case MORE_THAN_ONE_WORD = 'moreThanOneWord';
    case STARTS_WITH_W = 'startsWithW';
}
