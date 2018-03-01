<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.2.18
 * Time: 18:31
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Entity\TaskE;
use AppBundle\Forms\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ListController
 */
class ListController extends Controller
{
    /**
     *
     * @Route ("/list", name="list_of_tasks")
     *
     * @param UserInterface $user
     * @return Response
     */
    public function listAction(UserInterface $user)
    {
        $task = $this->getDoctrine()
            ->getRepository(TaskE::class)
            ->findBy(
                ['id_user' => $user->getId()],
                ['dueDate'=>'ASC']
            );

        return $this->render('list/list.html.twig', array(
            'tasks' => $task,
        ));
    }

    /**
     *
     * @Route("/create", name="create task")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request, UserInterface $user)
    {
        $form = $this->createForm(TaskType::class);

        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $task = new TaskE();
            $task->setTask($form['task']->getData());
            $task->setDueDate($form['dueDate']->getData());
            $task->setDescription($form['description']->getData());
            $task->setIdUser($user->getId());
            $em->persist($task);

            $em->flush();

            return $this->redirectToRoute('list_of_tasks');
        }


        return $this->render('list/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     *
     * @Route("/edit/{id}", name="edit task")
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $task = $this->getDoctrine()
            ->getRepository(TaskE::class)
            ->find($id);

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);


        if ($form->isValid() && $form->isSubmitted()) {
            $task->setTask($form['task']->getData());
            $task->setDueDate($form['dueDate']->getData());
            $task->setDescription($form['description']->getData());

            $em->persist($task);

            $em->flush();

            return $this->redirectToRoute('list_of_tasks');
        }

        return $this->render('list/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/delete/{id}", name="delete task")
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $task = $this->getDoctrine()
            ->getRepository(TaskE::class)
            ->find($id);

        $em->remove($task);

        $em->flush();

        return $this->redirectToRoute('list_of_tasks');
    }

    /**
     * @Route("/details/{id}", name="details")
     *
     * @param int $id
     *
     * @return Response
     */
    public function detailsAction($id)
    {
        $task = $this->getDoctrine()
            ->getRepository(TaskE::class)
            ->find($id);

        return $this->render('list/details.html.twig', array(
            'task' => $task,
        ));
    }
}
