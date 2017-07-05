<?php

namespace AppBundle\Controller;

use AppBundle\Entity\commodity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\commodityeditType;

/**
 * Commodity controller.
 *
 * @Route("commodity")
 */
class commodityController extends Controller {

    /**
     * Lists all commodity entities.
     *
     * @Route("/", name="commodity_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $commodities = $em->getRepository('AppBundle:commodity')->findAll();
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($commodities, 'json');


        return new Response($data);
    }

    /**
     * Creates a new commodity entity.
     *
     * @Route("/new/{name}/{barcode}/{buy}/{sale}/{fie}/{count}/{pic}/{adminid}", name="commodity_new")
     * @Method({"GET", "POST"})
     */
    public function newAction($name,$barcode,$buy,$sale,$pic,$count,$fie,$adminid) {
          $commodity = new commodity();
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(
                array('id' => $adminid));


        $commodity->setName($name);
        $commodity->setBarcode($barcode);
        $commodity->setBuy($buy);
        $commodity->setSale($sale);
        $commodity->setPic($pic);
        $commodity->setCount($count);
        $commodity->setFie($fie);
        $commodity->setAdmin($admin);
                
        $em->persist($commodity);
        $em->flush();
        $commodity->setMassage('success');
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($commodity, 'json');
        return new Response($data);
    }

    /**
     * Finds and displays a commodity entity.
     *
     * @Route("/{id}", name="commodity_show")
     * @Method("GET")
     */
    public function showAction($id) {
  $em = $this->getDoctrine()->getManager();
        $commodity = $em->getRepository('AppBundle:commodity')->findOneBy(
                array('id' => $id));
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize($commodity, 'json');
        return new Response($data);
    }

    /**
     * Displays a form to edit an existing commodity entity.
     *
     * @Route("/edit/{id}/{name}/{barcode}/{buy}/{sale}/{fie}/{count}/{pic}/{adminid}", name="commodity_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id,$name,$barcode,$buy,$sale,$pic,$count,$fie,$adminid) {
        
        $em = $this->getDoctrine()->getManager();
        $commodity = $em->getRepository('AppBundle:commodity')->findOneBy(
                array('id' => $id));
        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(
                array('id' => $adminid));


        $commodity->setName($name);
        $commodity->setBarcode($barcode);
        $commodity->setBuy($buy);
        $commodity->setSale($sale);
        $commodity->setPic($pic);
        $commodity->setCount($count);
        $commodity->setFie($fie);
        $commodity->setAdmin($admin);
                
        $em->persist($commodity);
        $em->flush();
        $serializer = $this->container->get('jms_serializer');
        $data = $serializer->serialize('TRUE', 'json');

        return new Response($data);
    }

    /**
     * Deletes a commodity entity.
     *
     * @Route("/{id}", name="commodity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, commodity $commodity) {
        $form = $this->createDeleteForm($commodity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commodity);
            $em->flush();
            $serializer = $this->container->get('jms_serializer');
            $data = $serializer->serialize('TRUE', 'json');
            return new Response($data);
        }
        return $this->redirectToRoute('commodity_index');
    }

    /**
     * Creates a form to delete a commodity entity.
     *
     * @param commodity $commodity The commodity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(commodity $commodity) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('commodity_delete', array('id' => $commodity->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    private function upload(commodity $commodity) {
        $file = $commodity->getPic();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move(
                $this->getParameter('pic_directory'), $fileName
        );
        $commodity->setPic($fileName);
    }

}
