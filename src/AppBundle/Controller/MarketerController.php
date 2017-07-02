<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Marketer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Marketer controller.
 *
 * @Route("marketer")
 */
class MarketerController extends Controller
{
    /**
     * Lists all marketer entities.
     *
     * @Route("/", name="marketer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $marketers = $em->getRepository('AppBundle:Marketer')->findAll();
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($marketers, 'json');
       

        return new Response($data);
        
    }

    /**
     * Creates a new marketer entity.
     *
     * @Route("/new", name="marketer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $marketer = new Marketer();
        $form = $this->createForm('AppBundle\Form\MarketerType', $marketer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $marketer->setRole('ROLE_USER');
            $em->persist($marketer);
            $em->flush();
            $marketer->setMassage('success');
            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize($marketer, 'json');

            return new Response($data);
        }

        return $this->render('marketer/new.html.twig', array(
            'marketer' => $marketer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a marketer entity.
     *
     * @Route("/{id}", name="marketer_show")
     * @Method("GET")
     */
    public function showAction(Marketer $marketer)
    {
        $deleteForm = $this->createDeleteForm($marketer);

        return $this->render('marketer/show.html.twig', array(
            'marketer' => $marketer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing marketer entity.
     *
     * @Route("/{id}/edit", name="marketer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Marketer $marketer)
    {
        $deleteForm = $this->createDeleteForm($marketer);
        $editForm = $this->createForm('AppBundle\Form\MarketerType', $marketer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
               $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize('TRUE', 'json');
            
        return new Response($data);
        }

        return $this->render('marketer/edit.html.twig', array(
            'marketer' => $marketer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a marketer entity.
     *
     * @Route("/{id}", name="marketer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Marketer $marketer)
    {
        $form = $this->createDeleteForm($marketer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($marketer);
            $em->flush();
             $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize('TRUE', 'json');
        }

       return new Response($data);
    }

    /**
     * Creates a form to delete a marketer entity.
     *
     * @param Marketer $marketer The marketer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Marketer $marketer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('marketer_delete', array('id' => $marketer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
      /**
     * Displays a form to edit an existing marketer entity.
     *
     * @Route("/{email}/{pass}/login", name="marketer_login")
     * @Method({"GET", "POST"})
     */
    public function loginAction($email,$pass) {
        $em = $this->getDoctrine()->getManager();
               $marketer = $em->getRepository('AppBundle:Marketer')->findOneBy(
    array('email' => $email, 'pass' => $pass));


//////////////////////////////////////////
      
        if($marketer){
            $serializer = $this->container->get('jms_serializer');
            $entity = $serializer->serialize($marketer, 'json');
  
        }
        else{
         $serializer = $this->container->get('jms_serializer');
            $entity = $serializer->serialize('FALSE', 'json');
       
        }
         return new Response($entity);
    }
    
}
