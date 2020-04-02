<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\RegisterType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/licence01")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_user_login")
     */
    public function login()
    {
        return $this->render('user/login.html.twig', [
            'controller_name' => 'Authentification',
        ]);
    }

    /**
     * @Route("/register", name="security_user_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        
        $form = $this->createForm(RegisterType::class, $user);

        $doctrine = $this->getDoctrine();
        $manager = $doctrine->getManager();

        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_user_login');
        }

        return $this->render('user/register.html.twig', [
            'controller_name' => 'Enregistrement',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="security_user_logout")
     */
    public function logout(){}
}
