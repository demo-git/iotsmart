<?php

namespace iotsmart\HueBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HueController extends Controller
{
    /**
     * Interface hue module
     *
     * @param string $token
     * @return Response
     *
     * @Route("/{token}", name="interface_hue")
     * @Method("GET")
     */
    public function indexAction(Request $request, $token)
    {
        $client = new Client();
        $result = $client->put($request->getSchemeAndHttpHost() . "/api/connection-string/hue/" . $token)->getBody()->getContents();
        return $this->render('iotsmartHueBundle:Hue:index.html.twig', array('url' => $result));
    }
}
