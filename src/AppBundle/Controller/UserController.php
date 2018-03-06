<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.2.18
 * Time: 18:31
 */
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Forms\UserEditType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     *
     * @Route("user/details/{id}", name="user_details")
     *
     * @param int $id
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

    /**
     *
     * @Route("/user/delete/{id}", name="delete_user")
     *
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        $em->remove($user);

        $em->flush();

        return $this->redirectToRoute('user_list');
    }

    /**
     *
     * @Route("/user/edit/{id}", name="edit_user")
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        $form = $this->createForm(UserEditType::class, $user);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $user->setLocation($form['location']->getData());
            $user->setLocation($form['description']->getData());

            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('user_list');
        }

        return $this->render('/user/edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
        ));
    }
}
