<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReceptyController extends AbstractController
{
    #[Route('/recepty', name: 'app_recepty')]
    public function index(): Response
    {
        return $this->render('recepty/index.html.twig', []);
    }
}
