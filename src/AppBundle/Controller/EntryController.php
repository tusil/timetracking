<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Entry;
use AppBundle\Form\EntryType;

/**
 * Entry controller.
 *
 * @Route("/app/entry")
 */
class EntryController extends Controller
{
    /**
     * Lists all Entry entities.
     *
     * @Route("/", name="app_entry_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entries = $em->getRepository('AppBundle:Entry')->findAll();

        return $this->render('entry/index.html.twig', array(
            'entries' => $entries,
        ));
    }

    /**
     * Creates a new Entry entity.
     *
     * @Route("/new", name="app_entry_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entry = new Entry();
        $form = $this->createForm('AppBundle\Form\EntryType', $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('app_entry_show', array('id' => $entry->getId()));
        }

        return $this->render('entry/new.html.twig', array(
            'entry' => $entry,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Entry entity.
     *
     * @Route("/{id}", name="app_entry_show")
     * @Method("GET")
     */
    public function showAction(Entry $entry)
    {
        $deleteForm = $this->createDeleteForm($entry);

        return $this->render('entry/show.html.twig', array(
            'entry' => $entry,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Entry entity.
     *
     * @Route("/{id}/edit", name="app_entry_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Entry $entry)
    {
        $deleteForm = $this->createDeleteForm($entry);
        $editForm = $this->createForm('AppBundle\Form\EntryType', $entry);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entry);
            $em->flush();

            return $this->redirectToRoute('app_entry_edit', array('id' => $entry->getId()));
        }

        return $this->render('entry/edit.html.twig', array(
            'entry' => $entry,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Entry entity.
     *
     * @Route("/delete/{id}", name="app_entry_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Entry $entry)
    {
      $project_id = $entry->getProject()->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entry);
            $em->flush();

/*      
        $form = $this->createDeleteForm($entry);
        $form->handleRequest($request);
        /
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entry);
            $em->flush();
        }*/

        return $this->redirectToRoute('entries', array('project_id'=>$project_id));
    }

    /**
     * Creates a form to delete a Entry entity.
     *
     * @param Entry $entry The Entry entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Entry $entry)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_entry_delete', array('id' => $entry->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
