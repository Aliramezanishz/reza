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
class MarketerController extends Controller {

    /**
     * Lists all marketer entities.
     *
     * @Route("/", name="marketer_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $marketers = $em->getRepository('AppBundle:Marketer')->findAll();
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($marketers, 'json');


        return new Response($data);
    }

    /**
     * Creates a new marketer entity.
     *
     * @Route("/new/{name}/{family}/{address}/{tel}/{nc}/{email}/{pass}/{presenter}/{adminid}", name="marketer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction($name, $family, $address, $tel, $nc, $email, $pass, $presenter, $adminid) {
        $marketer = new Marketer();
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(
                array('id' => $adminid));


        $marketer->setName($name);
        $marketer->setEmail($email);
        $marketer->setAddress($address);
        $marketer->setFamily($family);
        $marketer->setPass($pass);
        $marketer->setTel($tel);
        $marketer->setNc($nc);
        $marketer->setAdmin($admin);
        $marketer->setPresenter($presenter);
        $marketer->setRole('ROLE_USER');
        $em->persist($marketer);
        $em->flush();
        $marketer->setMassage('success');
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($marketer, 'json');
        return new Response($data);
    }

    /**
     * Finds and displays a marketer entity.
     *
     * @Route("/{id}", name="marketer_show")
     * @Method("GET")
     */
    public function showAction($id) {
      $em = $this->getDoctrine()->getManager();
        $marketer = $em->getRepository('AppBundle:Marketer')->findOneBy(
                array('id' => $id));
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($marketer, 'json');
        return new Response($data);
    }

    /**
     * Displays a form to edit an existing marketer entity.
     *
     * @Route("/edit/{id}/{name}/{family}/{address}/{tel}/{nc}/{email}/{pass}/{adminid}/{presenter}", name="marketer_edit")
     * @Method({"GET", "POST"})
     */
   public function editAction($id, $name, $family, $address, $tel, $nc, $email, $pass,$presenter,$adminid) {

        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(
                array('id' => $adminid));
        $marketer = $em->getRepository('AppBundle:Marketer')->findOneBy(
                array('id' => $id));

        $marketer->setName($name);
        $marketer->setEmail($email);
        $marketer->setAddress($address);
        $marketer->setFamily($family);
        $marketer->setPass($pass);
        $marketer->setTel($tel);
        $marketer->setNc($nc);
         $marketer->setAdmin($admin);
        $marketer->setPresenter($presenter);
        $em->persist($marketer);
        $em->flush();
       
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize('TRUE', 'json');

        return new Response($data);
    }

    /**
     * Deletes a marketer entity.
     *
     * @Route("/{id}", name="marketer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Marketer $marketer) {
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
    private function createDeleteForm(Marketer $marketer) {
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
    public function loginAction($email, $pass) {
        $em = $this->getDoctrine()->getManager();
        $marketer = $em->getRepository('AppBundle:Marketer')->findOneBy(
                array('email' => $email, 'pass' => $pass));


//////////////////////////////////////////

        if ($marketer) {
            $serializer = $this->container->get('jms_serializer');
            $entity = $serializer->serialize($marketer, 'json');
        } else {
            $serializer = $this->container->get('jms_serializer');
            $entity = $serializer->serialize('FALSE', 'json');
        }
        return new Response($entity);
    }

}
