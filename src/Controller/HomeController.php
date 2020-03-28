<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TodoRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TodoRepository $todoRepository)
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'Accueil',
            'todos' => $todoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/aPropos", name="aPropos")
     */
    public function aPropos()
    {
        return $this->render('home/apropos.html.twig', [
            'controller_name' => 'A propos',
        ]);
    }

    /**
     * @Route("/getStarted", name="getStarted")
     */
    public function getStarted()
    {
        return $this->render('home/getstarted.html.twig', [
            'controller_name' => 'Débuter avec la TodoList',
        ]);
    }
}
