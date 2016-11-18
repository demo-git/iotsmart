<?php

namespace ApiBundle\Controller;

use ApiBundle\Document\DataObject;
use FrontBundle\Entity\Module;
use FrontBundle\Entity\UserConnectedObject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DataApiController extends Controller
{
    /**
     * @Route()
     * @PUT("/load/{token}")
     * @param Request $request
     * @param string $token
     * @return Response
     */
    public function loadAction(Request $request, $token)
    {
        if ($request->isMethod("PUT") && !empty($token)) {
            $dataObjects = $this->get('doctrine_mongodb')->getRepository(DataObject::class)->findBy(array("tokenData" => $token), array("createAt", 'ASC'));

            $datas = array();
            if ($dataObjects) {
                $i = 0;
                foreach ($dataObjects as $dataObject) {
                    $datas[$i]["date"] = $dataObject->getCreateAt();
                    $datas[$i]["data"] = json_decode($dataObject->getDatas());
                    $i++;
                }
            } else {
                return new Response(json_encode(array()), 200);
            }

            return new Response(json_encode($datas), 200);
        }

        return new Response("Error format, PUT is required", 403);
    }

    /**
     * @Route(requirements={"_format"="json"})
     * @PUT("/save/{token}")
     * @param Request $request
     * @param string $token
     * @return Response
     */
    public function saveAction(Request $request, $token)
    {
        if ($request->isMethod("PUT") && !empty($token)) {
            $datas = new DataObject();
            $datas->setCreateAt(date("Y-m-d H:i:s"));
            $datas->setTokenData($token);
            $datas->setDatas($request->getContent());

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($datas);
            $dm->flush();

            return new Response("Datas added", 200);
        }

        return new Response("Error format, PUT is required", 403);
    }

    /**
     * @Route()
     * @PUT("/connection-string/{module}/{token}")
     * @param Request $request
     * @param string $module
     * @return Response
     */
    public function getTokensAction(Request $request, $module, $token)
    {
        if ($request->isMethod("PUT") && !empty($module)) {
            $em = $this->getDoctrine()->getManager();
            $module = $em->getRepository(Module::class)->findOneBy(array("name" => $module));
            $userConnectedObject = $em->getRepository(UserConnectedObject::class)->findOneBy(array("connectedObject" => $module->getObject()->getId(), "tokenData" => $token));
            if ($userConnectedObject) {
                return new Response($userConnectedObject->getConnectionString(), 200);
            }
            return new Response("No connection string", 200);
        }

        return new Response("Error format, PUT is required", 403);
    }
}
