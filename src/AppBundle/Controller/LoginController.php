<?php

namespace AppBundle\Controller;

use AppBundle\Forms\LogInType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     *
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $errors = $authenticationUtils->getLastAuthenticationError();

        $lastUserName = $authenticationUtils->getLastUsername();
        $form = $this->createForm(LogInType::class);

        $form->handleRequest($request);
        return $this->render('login/login.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors,
            'username' => $lastUserName,
        ));
    }

    /**
     *
     * @Route ("/logout", name="logout")
     */
    public function logoutAction(){


    }

}
