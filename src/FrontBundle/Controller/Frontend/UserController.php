<?php
/**
 * Created by PhpStorm.
 * User: Gess
 * Date: 15/11/2016
 * Time: 10:18
 */

namespace FrontBundle\Controller\Frontend;

use Doctrine\Common\Collections\ArrayCollection;
use FrontBundle\Entity\ConnectedObject;
use FrontBundle\Entity\Module;
use FrontBundle\Entity\User;
use FrontBundle\Entity\UserConnectedObject;
use FrontBundle\Form\UserConnectedObjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Lists all user object.
     *
     * @Route("/connectedObject", name="user_connected_object_index")
     * @Method("GET")
     */
    public function indexObjectAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        /** @var ArrayCollection $userObjects */
        $userObjects = $user->getUserConnectedObjects();

        return $this->render('FrontBundle:user_connected_object:index.html.twig', array(
            'userObjects' => $userObjects,
        ));
    }


    /**
     * Creates a new user entity.
     *
     * @Route("/connectedObject/new",options={"expose"=true}, name="user_connected_object_new")
     * @Method({"GET", "POST"})
     */
    public function newObjectAction(Request $request)
    {
        $userConnectedObject = new UserConnectedObject();
        $form = $this->createForm(UserConnectedObjectType::class , $userConnectedObject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userConnectedObject->setUser($this->getUser());
            $userConnectedObject->setTokenData(uniqid($this->getUser()->getId()), true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($userConnectedObject);
            $em->flush($userConnectedObject);

            return $this->redirectToRoute('user_connected_object_show', array('id' => $userConnectedObject->getConnectedObject()->getId()));
        }

        return $this->render('FrontBundle:user_connected_object:new.html.twig', array(
            'userConnectedObject' => $userConnectedObject,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/connectedObject/{id}/edit", name="user_connected_object_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        $userConnectedObject = $em->getRepository(UserConnectedObject::class)
            ->findOneBy(array("user" =>$user ->getId() , "connectedObject" => $id));

        $form = $this->createForm(UserConnectedObjectType::class , $userConnectedObject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userConnectedObject);
            $em->flush($userConnectedObject);

            return $this->redirectToRoute('user_connected_object_show', array('id' => $userConnectedObject->getConnectedObject()->getId()));
        }

        return $this->render('FrontBundle:user_connected_object:edit.html.twig', array(
            'userConnectedObject' => $userConnectedObject,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/connectedObject/{id}",options={"expose"=true}, name="user_connected_object_show")
     * @Method("GET")
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showObjectAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        $userObject = $em->getRepository(UserConnectedObject::class)
            ->findOneBy(array("user" =>$user ->getId() , "connectedObject" => $id));

        $userObjectModuleFull = $user->getModules();
        $userObjectModules= array();
        foreach($userObjectModuleFull as $module) {
            /** @var Module $module */
            if($module->getObject()->getId() == $id){
                $userObjectModules[] = $module;
            }
        }

        return $this->render('FrontBundle:user_connected_object:show.html.twig', array(
            'userObject' => $userObject,
            'userModuleObjects' => $userObjectModules
        ));
    }

    /**
     * Deletes a user connected object entity.
     *
     * @Route("/connectedObject/{id}/delete", name="user_connected_object_delete")
     * @Method("GET")
     */
    public function deleteObjectAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var User $user */
        $user = $this->getUser();
        $userObject = $em->getRepository(UserConnectedObject::class)
            ->findOneBy(array("user" =>$user ->getId() , "connectedObject" => $id));
        $em->remove($userObject);
        $em->flush();
        return $this->redirectToRoute('user_connected_object_index');
    }

    /**
     * Lists all user module.
     *
     * @Route("/module", name="user_module_index")
     * @Method("GET")
     */
    public function indexModuleAction()
    {
        /** @var User $user */
        $user =$this->getUser();
        $userModules = $user->getModules();

        return $this->render('FrontBundle:user_module:index.html.twig', array(
            'userModules' => $userModules,
        ));
    }

    /**
     * Deletes a module user entity.
     *
     * @Route("/module/{id}/delete", name="user_module_delete")
     * @Method("GET")
     */
    public function deleteModuleAction(Module $module)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $user->removeModule($module);
        $module->removeUser($user);
        $em->persist($user);
        $em->persist($module);
        $em->flush();
        return $this->redirectToRoute('user_module_index');
    }
}