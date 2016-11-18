<?php

namespace iotsmart\fitbitBundle\Controller;

use Fabulator\FitBit;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class FitbitController extends Controller
{
    /**
     * Interface fitbit module
     *
     * @param string $token
     * @return Response
     *
     * @Route("/{token}", name="interface_fitbit")
     * @Method("GET")
     */
    public function indexAction(Request $request, $token)
    {
        $client = new Client();
        $result = explode('_',$client->put($request->getSchemeAndHttpHost() . "/api/connection-string/fitbit/" . $token)->getBody()->getContents());

        if ($result == 'No connection string') {
            return $this->createNotFoundException('Token invalide');
        }
        $fitbit = new FitBit($result[0], $result[1]);

        //On check si un token est stocké
        $session = $request->getSession();
        $session->set('FitbitToken', $token);
        $session->set('FitbitConnect', $result[0] . '_' . $result[1]);
        $fitbitToken = $session->get('FitbitToken_' . $token);

        if($fitbitToken) {
            $fitbit->setToken($fitbitToken);
        } else {
            //Sinon on crée une nouvelle demande de token
            //On génère l'url de login et on redirige dessus, après login l'utilisateur est redirigé ici
            $fitbitLoginUrl = $fitbit->getLoginUrl($request->getSchemeAndHttpHost() . $this->generateUrl('callback_fitbit'), ['profile','nutrition','heartrate','location','settings','activity','sleep','social','weight'], 'code', 86400);
            return $this->redirect($fitbitLoginUrl);
        }
        $datas = json_decode($client->put($request->getSchemeAndHttpHost() . "/api/load/" . $token)->getBody()->getContents(), true);

        if (count($datas) == 0) {
            $date = new \DateTime();
            $i = 0;
        } else {
            $date = new \DateTime($datas[count($datas) - 1]['date']['date']);
            $i = count($datas) - 1;
        }
        $dateNow = new \DateTime();
        $dateNow->modify('+1 day');

        while ($date->format('Y-m-d') != $dateNow->format('Y-m-d')) {
            $datas[$i]['date'] = $date;
            $saveDatas = json_encode($fitbit->heart->getDetailedHR($date));
            $datas[$i]['data'] = json_decode($saveDatas, true);
            if ($date->format('Y-m-d') == $dateNow->format('Y-m-d')) {
                $end = $client->put($request->getSchemeAndHttpHost() . "/api/save/" . $token, array(
                    "headers" => array(
                        'Content-type' => 'application/json'
                    ),
                    'body' => $saveDatas
                ));
            }
            $date = clone $date;
            $date->modify('+1 day');
            $i++;
        }

        $datas = array_reverse($datas);

        foreach ($datas as $key => $data) {
            $datas[$key]["data"]["activities-heart-intraday"]["dataset"] = array_reverse($data["data"]["activities-heart-intraday"]["dataset"]);
        }

        return $this->render('iotsmartfitbitBundle:fitbit:index.html.twig', array("token" => $token, 'datas' => $datas));
    }

    /**
     * Interface fitbit module
     *
     * @return Response
     *
     * @Route("/callback/oauth", name="callback_fitbit")
     * @Method("GET")
     */
    public function callbackAction(Request $request)
    {
        $session = $request->getSession();
        $result = explode('_', $session->get('FitbitConnect'));
        $fitbit = new FitBit($result[0], $result[1]);
        $tok = $fitbit->getToken($request->get('code'), $request->getSchemeAndHttpHost() . $this->generateUrl('callback_fitbit'));
        $session->set('FitbitToken_' . $session->get('FitbitToken'), $tok);

        return $this->redirectToRoute('interface_fitbit', array('token' => $session->get('FitbitToken')));
    }
}
