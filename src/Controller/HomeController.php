<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TodoRepository;
use App\Repository\UsergroupRepository;

use Symfony\Component\Security\Core\Security;

/**
 * @Route("/licence01")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TodoRepository $todoRepository, Security $security, UsergroupRepository $usergroupRepository)
    {
        $userGrp = $usergroupRepository->findAllUG();

        return $this->render('home/home.html.twig', [
            'controller_name' => 'Accueil',
            'todos' => $todoRepository->getTodoList($userGrp)
        ]);
    }

    /**
     * @Route("/doneTodo", name="todoDone")
     */
    public function doneTodo(TodoRepository $todoRepository, Security $security, UsergroupRepository $usergroupRepository)
    {
        return $this->render('home/doneTodo.html.twig', [
            'controller_name' => 'Todo terminés',
            'todos' => $todoRepository->getTodoList($usergroupRepository->findAllUG()),
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
