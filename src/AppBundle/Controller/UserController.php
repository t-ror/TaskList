<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends Controller
{
    /**
     *
     * @Route("user/details/{id}", name="user_details")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailsAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        return $this->render('/user/details.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     *
     * @Route("/user/list", name="user_list")
     *
     * @param UserInterface $user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(UserInterface $user)
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->loadUserList($user->getId());

        return $this->render('/user/list.html.twig', array(
             'users' => $users,
        ));
    }

}
