<?php
/**
 * Created by PhpStorm.
 * User: Gess
 * Date: 16/11/2016
 * Time: 01:46
 */

namespace FrontBundle\Controller\Frontend;

use FrontBundle\Entity\ConnectedObject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Intl\Exception\NotImplementedException;

/**
 * Module controller.
 *
 * @Route("/connectedObject")
 */
class ConnectedObjectController extends Controller
{
    /**
     * Lists all modules.
     *
     * @Route("/", name="connected_object_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $connectedObjects = $em->getRepository(ConnectedObject::class)->findAll();

        return $this->render('FrontBundle:connected_object:index.html.twig', array(
            'connected_objects' => $connectedObjects,
        ));
    }

    /**
     * Finds and displays a Module entity.
     *
     * @Route("/{id}",options={"expose"=true}, name="connected_object_show")
     * @Method("GET")
     *
     * @param ConnectedObject $connectedObject
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(ConnectedObject $connectedObject)
    {
        $user = $this->getUser();

        $userObjectModuleFull = $user->getModules();
        $userObjectModule= array();
        foreach($userObjectModuleFull as $module) {
            /** @var Module $module */
            if($module->getObject()->getId() == $connectedObject->getId()){
                $userObjectModule[] = $module;
            }
        }

        return $this->render('FrontBundle:connected_object:show.html.twig', array(
            'connected_object' => $connectedObject,
            'user_module_object' => $userObjectModule
        ));
    }
}