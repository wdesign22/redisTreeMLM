<?php

namespace Eugene\Blog2Bundle\Controller;

use Eugene\Blog2Bundle\Entity\post2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Post2 controller.
 *
 * @Route("post2")
 */
class post2Controller extends Controller
{
    /**
     * Lists all post2 entities.
     *
     * @Route("/", name="post2_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        echo "post2_index";
        $em = $this->getDoctrine()->getManager();

        $post2s = $em->getRepository('EugeneBlog2Bundle:post2')->findAll();

        return $this->render('post2/index.html.twig', array(
            'post2s' => $post2s,
        ));
    }

    /**
     * Creates a new post2 entity.
     *
     * @Route("/new", name="post2_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $post2 = new Post2();
        $form = $this->createForm('Eugene\Blog2Bundle\Form\post2Type', $post2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post2);
            $em->flush();

            return $this->redirectToRoute('post2_show', array('id' => $post2->getId()));
        }

        return $this->render('post2/new.html.twig', array(
            'post2' => $post2,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a post2 entity.
     *
     * @Route("/{id}", name="post2_show")
     * @Method("GET")
     */
    public function showAction(post2 $post2)
    {
        $deleteForm = $this->createDeleteForm($post2);

        return $this->render('post2/show.html.twig', array(
            'post2' => $post2,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing post2 entity.
     *
     * @Route("/{id}/edit", name="post2_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, post2 $post2)
    {
        $deleteForm = $this->createDeleteForm($post2);
        $editForm = $this->createForm('Eugene\Blog2Bundle\Form\post2Type', $post2);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post2_edit', array('id' => $post2->getId()));
        }

        return $this->render('post2/edit.html.twig', array(
            'post2' => $post2,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a post2 entity.
     *
     * @Route("/{id}", name="post2_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, post2 $post2)
    {
        $form = $this->createDeleteForm($post2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post2);
            $em->flush();
        }

        return $this->redirectToRoute('post2_index');
    }

    /**
     * Creates a form to delete a post2 entity.
     *
     * @param post2 $post2 The post2 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(post2 $post2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post2_delete', array('id' => $post2->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
