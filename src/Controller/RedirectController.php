<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class RedirectController extends AbstractController
{
    #[Route('/', name: 'home')]
    #[Route('/{slug}', name: 'default_redirect', requirements: ['slug' => '.+'])]
    public function redirectToMenu(): RedirectResponse
    {
        // Redirect all invalid or empty routes to the 'menu' route
        return new RedirectResponse($this->generateUrl('app_menu_index'));
    }
}