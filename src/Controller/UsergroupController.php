<?php

namespace App\Controller;

use App\Entity\Usergroup;
use App\Form\UsergroupType;
use App\Repository\UsergroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/licence01/usergroup")
 * @IsGranted("ROLE_USER")
 */
class UsergroupController extends AbstractController
{
    /**
     * @Route("/", name="usergroup_index", methods={"GET"})
     */
    public function index(UsergroupRepository $usergroupRepository): Response
    {
        return $this->render('usergroup/index.html.twig', [
            'usergroups' => $usergroupRepository->findAllUG(),
        ]);
    }

    /**
     * @Route("/new", name="usergroup_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $usergroup = new Usergroup();
        $form = $this->createForm(UsergroupType::class, $usergroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usergroup);
            $entityManager->flush();

            return $this->redirectToRoute('usergroup_index');
        }

        return $this->render('usergroup/new.html.twig', [
            'usergroup' => $usergroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="usergroup_show", methods={"GET"})
     */
    public function show(Usergroup $usergroup): Response
    {
        return $this->render('usergroup/show.html.twig', [
            'usergroup' => $usergroup,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="usergroup_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Usergroup $usergroup): Response
    {
        $form = $this->createForm(UsergroupType::class, $usergroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usergroup_index');
        }

        return $this->render('usergroup/edit.html.twig', [
            'usergroup' => $usergroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="usergroup_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Usergroup $usergroup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usergroup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usergroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('usergroup_index');
    }
}
