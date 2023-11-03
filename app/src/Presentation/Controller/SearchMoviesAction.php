<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\Query\FindMoviesQuery;
use App\Domain\MovieSearchAlgorithm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class SearchMoviesAction extends AbstractController
{
    public function __construct(private readonly FindMoviesQuery $query)
    {
    }

    #[Route('/api/movies/search', methods: 'GET')]
    public function __invoke(Request $request): JsonResponse
    {
        /** @var MovieSearchAlgorithm $algorithm */
        $algorithm = $request->query->getEnum('algorithm', MovieSearchAlgorithm::class);
        $matchedMovies = $this->query->findMatchingByAlgorithm($algorithm);

        return $this->json($matchedMovies);
    }
}
