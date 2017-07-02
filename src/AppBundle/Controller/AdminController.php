<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller {

    /**
     * Lists all admin entities.
     *
     * @Route("/", name="admin_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $admins = $em->getRepository('AppBundle:Admin')->findAll();
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($admins, 'json');

        return new Response($data);
    }

    /**
     * Creates a new admin entity.
     *
     * @Route("/new", name="admin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $admin = new Admin();
        $form = $this->createForm('AppBundle\Form\AdminType', $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $admin->setRole('ROLE_ADMIN');

            $em->persist($admin);
            $em->flush();
            $admin->setMassage('sucsecc');
            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize($admin, 'json');
            return new Response($data);
        }

        return $this->render('admin/new.html.twig', array(
                    'admin' => $admin,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a admin entity.
     *
     * @Route("/{id}", name="admin_show")
     * @Method("GET")
     */
    public function showAction(Admin $admin) {
        $deleteForm = $this->createDeleteForm($admin);

        return $this->render('admin/show.html.twig', array(
                    'admin' => $admin,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing admin entity.
     *
     * @Route("/{id}/edit", name="admin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Admin $admin) {
        $deleteForm = $this->createDeleteForm($admin);
        $editForm = $this->createForm('AppBundle\Form\AdminType', $admin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize('TRUE', 'json');

            return new Response($data);
        }

        return $this->render('admin/edit.html.twig', array(
                    'admin' => $admin,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a admin entity.
     *
     * @Route("/{id}", name="admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Admin $admin) {
        $form = $this->createDeleteForm($admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($admin);
            $em->flush();
            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize('TRUE', 'json');
            return new Response($data);
        }
        return $this->redirectToRoute('admin_index');
    }

    /**
     * Creates a form to delete a admin entity.
     *
     * @param Admin $admin The admin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Admin $admin) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_delete', array('id' => $admin->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing admin entity.
     *
     * @Route("/{email}/{pass}/login", name="admin_login")
     * @Method({"GET", "POST"})
     */
    public function loginAction($email, $pass) {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(
                array('email' => $email, 'pass' => $pass));


//////////////////////////////////////////

        if ($admin) {
            $serializer = $this->container->get('jms_serializer');
            $entity = $serializer->serialize($admin, 'json');
        } else {
            $serializer = $this->container->get('jms_serializer');
            $entity = $serializer->serialize('FALSE', 'json');
        }
        return new Response($entity);
    }

}
