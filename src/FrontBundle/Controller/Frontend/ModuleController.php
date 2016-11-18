<?php
/**
 * Created by PhpStorm.
 * User: Gess
 * Date: 16/11/2016
 * Time: 01:46
 */

namespace FrontBundle\Controller\Frontend;

use FrontBundle\Entity\Module;
use FrontBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Module controller.
 *
 * @Route("/module")
 */
class ModuleController extends Controller
{
    /**
     * Lists all modules.
     *
     * @Route("/", name="module_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        // TODO check url params for filter => ?appareil=adevice

        $em = $this->getDoctrine()->getManager();

        $allmodules = $em->getRepository(Module::class)->findAll();
        $modules = Array();
//        $filters = thisl;

        $nameFilter = $request->query->get('objectName');
        $filters = $nameFilter == null
            ? null
            : array("objectName" => $nameFilter);

        $moduleName = $allmodules[0]->getObject()->getName();

        if($filters != null)
        {
            foreach ($allmodules as $item)
                if( strtolower($item->getObject()->getName()) == strtolower($filters["objectName"]) )
                    $modules[] = $item;
        }
        else
            $modules = $allmodules;

        $userModules =$this->getUser()->getModules()->toArray();
        
        return $this->render('FrontBundle:module:index.html.twig', array(
            'modules' => $modules,
            'user_modules' => $userModules,
            'filters' => $filters,
            'test' => $moduleName
        ));
    }

    /**
     * Finds and displays a Module entity.
     *
     * @Route("/{id}/add", options={"expose"=true},name="module_add")
     * @Method("GET")
     *
     * @param Module $module
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Module $module)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        $user->addModule($module);
        $module->addUser($user);
        $em->persist($user);
        $em->persist($module);
        $em->flush();
        return $this->redirectToRoute('user_module_index');
    }

    /**
     * Finds and displays a Module entity.
     *
     * @Route("/{id}", options={"expose"=true},name="module_show")
     * @Method("GET")
     *
     * @param Module $module
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Module $module)
    {
        $userModules = $this->getUser()->getModules()->toArray();
        $moduleInstalled = false;

        foreach ($userModules as $mod) {
            if ($mod->getId() == $module->getId()) {
                $moduleInstalled = true;
                break;
            }
        }

        return $this->render('FrontBundle:module:show.html.twig', array(
            'module' => $module,
            'moduleInstalled' => $moduleInstalled
        ));
    }
}