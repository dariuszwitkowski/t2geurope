<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CounterController extends AbstractController
{
    #[Route('/', name: 'app_counter')]
    public function index()
    {
        return $this->render('counter/counter.html.twig');
    }
}
