<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Project;
use AppBundle\Entity\Entry;
use AppBundle\Form\EntryType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:index.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    
    /**
     * @Route("/app/dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p, c
            FROM AppBundle:Project p
            JOIN p.client c
            ORDER BY c.name ASC, p.name ASC'
        );
        
        $projects = $query->getResult();
        
        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:dashboard.html.twig', [
            'projects' => $projects,
        ]);
    }  
    
    /**
     * @Route("/app/entries/{project_id}", name="entries")
     * @ParamConverter("project", class="AppBundle:Project", options={"id" = "project_id"})
     */
    public function entriesAction(Request $request, Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        $from = $request->get('from', strtotime('first day of this month'));
        $to = $request->get('to', strtotime('last day of this month'));
        
        $entry = new Entry();
        $entry->setProject($project);
        $entry->setUser($this->getUser());
        $entry->setIssuedAt(new \DateTime());
        $entry->setCreatedAt(new \DateTime());
        
        $form = $this->createForm(EntryType::class, $entry, array(
            'action' => $this->generateUrl('entries', array('project_id'=>$project->getId())),
            'method' => 'POST',
        ));
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            $em->persist($entry);
            $em->flush();
    
            return $this->redirectToRoute('entries', array('project_id'=>$project->getId()));
        }
                
        
        $query = $em->createQuery(
            'SELECT e, u
            FROM AppBundle:Entry e
            JOIN e.user u
            WHERE e.project = :project
            ORDER BY e.issuedAt DESC, e.createdAt DESC'
        )->setParameter('project', $project);
        
        $entries = $query->getResult();
        
        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:entries.html.twig', [
            'project'=> $project,
            'entries' => $entries,
            'form' => $form->createView()
        ]);
    }        
}
