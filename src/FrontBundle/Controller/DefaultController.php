<?php
/**
 * Created by PhpStorm.
 * User: Gess
 * Date: 15/11/2016
 * Time: 10:18
 */

namespace FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * Lists all user object.
     *
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function indexObjectAction()
    {
        return $this->redirectToRoute('user_connected_object_index');
    }
}