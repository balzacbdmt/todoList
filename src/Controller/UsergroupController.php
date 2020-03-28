<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsergroupController extends AbstractController
{
    /**
     * @Route("/usergroup/add", name="usergroupAdd")
     */
    public function usergroupAdd()
    {
        return $this->render('usergroup/add.html.twig', [
            'controller_name' => 'usergroupAdd',
        ]);
    }

    /**
     * @Route("/usergroup/edit", name="usergroupEdit")
     */
    public function usergroupEdit()
    {
        return $this->render('usergroup/edit.html.twig', [
            'controller_name' => 'usergroupEdit',
        ]);
    }

    /**
     * @Route("/usergroup/remove", name="usergroupremove")
     */
    public function usergroupRemove()
    {
        //TODO
        return $this->render('home/home.html.twig', [
            'controller_name' => 'Accueil',
        ]);
    }
}
