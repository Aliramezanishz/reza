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
     * @Route("/new", name="orders_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $order = new orders();
        $form = $this->createForm('AppBundle\Form\ordersType', $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            $order->setMassage('Success');
            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize($order, 'json');
            return new Response($data);
        }

        return $this->render('orders/new.html.twig', array(
                    'order' => $order,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a order entity.
     *
     * @Route("/{id}", name="orders_show")
     * @Method("GET")
     */
    public function showAction(orders $order) {
        $deleteForm = $this->createDeleteForm($order);

        return $this->render('orders/show.html.twig', array(
                    'order' => $order,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing order entity.
     *
     * @Route("/{id}/edit", name="orders_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, orders $order) {
        $deleteForm = $this->createDeleteForm($order);
        $editForm = $this->createForm('AppBundle\Form\ordersType', $order);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize('TRUE', 'json');

            return new Response($data);
        }

        return $this->render('orders/edit.html.twig', array(
                    'order' => $order,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
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
