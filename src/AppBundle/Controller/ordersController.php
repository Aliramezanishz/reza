<?php

namespace AppBundle\Controller;

use AppBundle\Entity\orders;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Order controller.
 *
 * @Route("orders")
 */
class ordersController extends Controller {

    /**
     * Lists all order entities.
     *
     * @Route("/", name="orders_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $orders = $em->getRepository('AppBundle:orders')->findAll();
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($orders, 'json');


        return new Response($data);
    }

    /**
     * Creates a new order entity.
     *
     * @Route("/new/{customerid}/{marketerid}/{commodityid}/{count}", name="orders_new")
     * @Method({"GET", "POST"})
     */
    public function newAction($customerid, $marketerid, $commodityid, $count) {
        $order = new orders();
        $em = $this->getDoctrine()->getManager();
        ////////////////////////relation other entity/////////////////
        $commodity = $em->getRepository('AppBundle:commodity')->findOneBy(
                array('id' => $commodityid));

        $customer = $em->getRepository('AppBundle:Customer')->findOneBy(
                array('id' => $customerid));

        $marketer = $em->getRepository('AppBundle:Marketer')->findOneBy(
                array('id' => $marketerid));

        //////////////////////////////////////////////////////////////  
        $order->setCustomer($customer);
        $order->setMarketer($marketer);
        $order->setCommodity($commodity);
        $order->setCount($count);
        $em->persist($order);
        $em->flush();
        $order->setMassage('Success');
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($order, 'json');
        return new Response($data);
    }

    /**
     * Finds and displays a order entity.
     *
     * @Route("/{id}", name="orders_show")
     * @Method("GET")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:orders')->findOneBy(
                array('id' => $id));
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($order, 'json');
        return new Response($data);
    }

    /**
     * Displays a form to edit an existing order entity.
     *
     * @Route("/edit/{id}/{customerid}/{marketerid}/{commodityid}/{count}", name="orders_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id, $customerid, $marketerid, $commodityid, $count) {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:orders')->findOneBy(
                array('id' => $id));
        ////////////////////////relation other entity/////////////////
        $commodity = $em->getRepository('AppBundle:commodity')->findOneBy(
                array('id' => $commodityid));

        $customer = $em->getRepository('AppBundle:Customer')->findOneBy(
                array('id' => $customerid));

        $marketer = $em->getRepository('AppBundle:Marketer')->findOneBy(
                array('id' => $marketerid));

        //////////////////////////////////////////////////////////////  
        $order->setCustomer($customer);
        $order->setMarketer($marketer);
        $order->setCommodity($commodity);
        $order->setCount($count);
        $em->persist($order);
        $em->flush();
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize('TRUE', 'json');

        return new Response($data);
    }

    /**
     * Deletes a order entity.
     *
     * @Route("/{id}", name="orders_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, orders $order) {
        $form = $this->createDeleteForm($order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($order);
            $em->flush();
            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize('TRUE', 'json');

            return new Response($data);
        }

        return $this->redirectToRoute('orders_index');
    }

    /**
     * Creates a form to delete a order entity.
     *
     * @param orders $order The order entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(orders $order) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('orders_delete', array('id' => $order->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
