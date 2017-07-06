<?php

namespace RedisTreeBundle\Controller;

use RedisTreeBundle\Entity\mlmUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Mlmuser controller.
 *
 * @Route("redis")
 */
class mlmUserController extends Controller
{
    /**
     * Lists all mlmUser entities.
     *
     * @Route("/", name="redis_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mlmUsers = $em->getRepository('RedisTreeBundle:mlmUser')->findAll();

        return $this->render('mlmuser/index.html.twig', array(
            'mlmUsers' => $mlmUsers,
        ));
    }

    /**
     * Creates a new mlmUser entity.
     *
     * @Route("/new", name="redis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mlmUser = new Mlmuser();
        $form = $this->createForm('RedisTreeBundle\Form\mlmUserType', $mlmUser);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($mlmUser);
            $em->flush();
            $em->getRepository('RedisTreeBundle:mlmUser')->saveRedis($mlmUser);

            return $this->redirectToRoute('redis_show', array('id' => $mlmUser->getId()));
        }

        return $this->render('mlmuser/new.html.twig', array(
            'mlmUser' => $mlmUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a mlmUser entity.
     *
     * @Route("/{id}", name="redis_show")
     * @Method("GET")
     */
    public function showAction(mlmUser $mlmUser)
    {
        $deleteForm = $this->createDeleteForm($mlmUser);

        $em = $this->getDoctrine()->getManager();
        $ancestorsArray = $em->getRepository('RedisTreeBundle:mlmUser')->getAncestors($mlmUser);

        print_r (  $ancestorsArray ); // лом с твигом разбираться как массивы парсить

        return $this->render('mlmuser/show.html.twig', array(
            'mlmUser' => $mlmUser,
            'delete_form' => $deleteForm->createView(),
            ' $ancestorsArray' => $ancestorsArray
        ));
    }

    /**
     * Displays a form to edit an existing mlmUser entity.
     *
     * @Route("/{id}/edit", name="redis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, mlmUser $mlmUser)
    {
        $deleteForm = $this->createDeleteForm($mlmUser);
        $editForm = $this->createForm('RedisTreeBundle\Form\mlmUserType', $mlmUser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('redis_edit', array('id' => $mlmUser->getId()));
        }

        return $this->render('mlmuser/edit.html.twig', array(
            'mlmUser' => $mlmUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing mlmUser entity.
     *
     * @Route("/ancestors/{id}/", name="redis_ancestors")
     * @Method({"GET", "POST"})
     */
    public function ancestorsAction($id)
    {

        return $this->render('ancestors.html.twig', array(

            'id' => $id
        ));

    }


    /**
     * Deletes a mlmUser entity.
     *
     * @Route("/{id}", name="redis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, mlmUser $mlmUser)
    {
        $form = $this->createDeleteForm($mlmUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mlmUser);
            $em->flush();
        }

        return $this->redirectToRoute('redis_index');
    }

    /**
     * Creates a form to delete a mlmUser entity.
     *
     * @param mlmUser $mlmUser The mlmUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(mlmUser $mlmUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('redis_delete', array('id' => $mlmUser->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
