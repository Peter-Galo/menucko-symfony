<?php

namespace App\Controller;

use App\Service\MenuService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu_index')]
    public function index(MenuService $menuService): Response
    {
        $menu = $menuService->getWeeklyMenu();

        return $this->render('menu/index.html.twig', [
            'weekdays' => $menu['weekdays'],
            'weekend' => $menu['weekend'],
        ]);
    }

    #[Route('/menu/generate', name: 'app_menu_generate')]
    public function generate(MenuService $menuService): Response
    {
        $menuService->regenerateMenu(); // this clears + generates
        return $this->redirectToRoute('app_menu_index');
    }


    #[Route('/menu/pdf', name: 'app_menu_pdf')]
    public function downloadPdf(MenuService $menuService): StreamedResponse
    {
        return $menuService->generateWeeklyMenuPdf(); // Uses cached menu
    }
}
