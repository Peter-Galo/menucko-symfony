<?php

namespace App\Controller;

use App\Repository\ReceptRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ReceptyController extends AbstractController
{
    /**
     * Displays recepty grouped by category and type.
     *
     * @param ReceptRepository $receptRepository
     * @return Response
     */
    #[Route('/recepty', name: 'app_recepty')]
    public function index(ReceptRepository $receptRepository): Response
    {
        // Fetch all recepty ordered by category and type for efficient grouping
        $recepty = $receptRepository->findAllOrderedByCategory();

        // Group into: category -> type -> list of recepts
        $groupedRecepty = [];

        foreach ($recepty as $recept) {
            $category = $recept->getCategory();
            $type = $recept->getType() ?? 'null';

            $groupedRecepty[$category][$type][] = $recept;
        }

        // Sort categories and types alphabetically, case-insensitive natural order
        ksort($groupedRecepty, SORT_NATURAL | SORT_FLAG_CASE);
        foreach ($groupedRecepty as &$types) {
            ksort($types, SORT_NATURAL | SORT_FLAG_CASE);
        }

        return $this->render('recepty/index.html.twig', compact('groupedRecepty'));
    }
}
