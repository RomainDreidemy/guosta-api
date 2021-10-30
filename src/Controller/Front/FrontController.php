<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/{reactRouting}', name: 'front', defaults: ['reactRouting' => null])]
    public function index(): Response
    {
        return $this->render('front/index.html.twig', []);
    }
}
