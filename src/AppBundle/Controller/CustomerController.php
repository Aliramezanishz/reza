<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Customer controller.
 *
 * @Route("customer")
 */
class CustomerController extends Controller {

    /**
     * Lists all customer entities.
     *
     * @Route("/", name="customer_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $customers = $em->getRepository('AppBundle:Customer')->findAll();
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($customers, 'json');

        return new Response($data);
    }

    /**
     * Creates a new customer entity.
     *
     * @Route("/new/{name}/{family}/{address}/{tel}/{location}/{subscribe}", name="customer_new")
     * @Method({"GET", "POST"})
     */
      public function newAction($name, $family, $address, $tel, $location, $subscribe) {
        $customer = new Customer();
        $em = $this->getDoctrine()->getManager();
      


        $customer->setName($name);
        $customer->setFamily($family);
        $customer->setAddress($address);
        $customer->setTel($tel);
        $customer->setLocation($location);
        $customer->setSubscribe($subscribe);
        
      
        $em->persist($customer);
        $em->flush();
        $customer->setMassage('success');
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($customer, 'json');
        return new Response($data);
    }

    /**
     * Finds and displays a customer entity.
     *
     * @Route("/{id}", name="customer_show")
     * @Method("GET")
     */
    public function showAction($id) {
       $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository('AppBundle:Customer')->findOneBy(
                array('id' => $id));
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($customer, 'json');
        return new Response($data);
    }

    /**
     * Displays a form to edit an existing customer entity.
     *
     * @Route("/edit/{id}/{name}/{family}/{address}/{tel}/{location}/{subscribe}", name="customer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id, $name, $family, $address, $tel, $location, $subscribe) {

        $em = $this->getDoctrine()->getManager();
        
        $customer = $em->getRepository('AppBundle:Customer')->findOneBy(
                array('id' => $id));

        $customer->setName($name);
        $customer->setFamily($family);
        $customer->setAddress($address);
        $customer->setTel($tel);
        $customer->setLocation($location);
        $customer->setSubscribe($subscribe);
        $em->persist($customer);
        $em->flush();
       
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize('TRUE', 'json');

        return new Response($data);
    }
    /**
     * Deletes a customer entity.
     *
     * @Route("/{id}", name="customer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Customer $customer) {
        $form = $this->createDeleteForm($customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush();
            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize('TRUE', 'json');
            return new Response($data);
        }

        return $this->redirectToRoute('customer_index');
    }

    /**
     * Creates a form to delete a customer entity.
     *
     * @param Customer $customer The customer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Customer $customer) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('customer_delete', array('id' => $customer->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
