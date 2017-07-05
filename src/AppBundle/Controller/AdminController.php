<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        $admins = $em->getRepository('AppBundle:Admin')->findBy(
                array('del' => '0'));

        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($admins, 'json');

        return new Response($data);
    }

    /**
     * Creates a new admin entity.
     *
     * @Route("/new/{name}/{family}/{address}/{tel}/{nc}/{email}/{pass}", name="admin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction($name, $family, $address, $tel, $nc, $email, $pass) {
        $admin = new Admin();



        $em = $this->getDoctrine()->getManager();
        $admin->setName($name);
        $admin->setEmail($email);
        $admin->setAddress($address);
        $admin->setFamily($family);
        $admin->setPass($pass);
        $admin->setTel($tel);
        $admin->setNc($nc);
        $admin->setDel('0');
        $admin->setRole('ROLE_ADMIN');
        $em->persist($admin);
        $em->flush();
        $admin->setMassage('success');
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($admin, 'json');
        return new Response($data);
    }

    /**
     * Finds and displays a admin entity.
     *
     * @Route("/{id}", name="admin_show")
     * @Method("GET")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(
                array('id' => $id,'del' => '0'));
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($admin, 'json');
        return new Response($data);
    }

    /**
     * Displays a form to edit an existing admin entity.
     *
     * @Route("/edit/{id}/{name}/{family}/{address}/{tel}/{nc}/{email}/{pass}", name="admin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id, $name, $family, $address, $tel, $nc, $email, $pass) {

        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(
                array('id' => $id));

        $admin->setName($name);
        $admin->setEmail($email);
        $admin->setAddress($address);
        $admin->setFamily($family);
        $admin->setPass($pass);
        $admin->setTel($tel);
        $admin->setNc($nc);
        $em->persist($admin);
        $em->flush();

        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize('TRUE', 'json');

        return new Response($data);
    }

    /**
     * Delete a admin entity.
     *
     * @Route("/delete/{id}", name="admin_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();

        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(
                array('id' => $id));

        $admin->setDel('1');

        $em->persist($admin);
        $em->flush();

        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize('TRUE', 'json');

        return new Response($data);
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
