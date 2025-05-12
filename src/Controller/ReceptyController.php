<?php

namespace App\Controller;

use App\Entity\Recept;
use App\Form\ReceptType;
use App\Repository\ReceptRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recepty')]
final class ReceptyController extends AbstractController
{
    /**
     * Displays recepty grouped by category and type.
     *
     * @param ReceptRepository $receptRepository
     * @return Response
     */
    #[Route('', name: 'app_recepty_index', methods: ['GET'])]
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

    #[Route('/add', name: 'app_recepty_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $recept = new Recept();
        $form = $this->createForm(ReceptType::class, $recept);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Auto-clear type if category is 'masko'
            if ($recept->getCategory() === 'masko') {
                $recept->setType(null);
            }

            $em->persist($recept);
            $em->flush();

            return $this->redirectToRoute('app_recepty_index');
        }

        return $this->render('recepty/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
