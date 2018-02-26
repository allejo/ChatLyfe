<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Channel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        if (!$user instanceof UserInterface) {
            return $this->render(':home:index-no-auth.html.twig', array(

            ));
        }

        $em = $this->getDoctrine()->getManager();
        $allChannels = $em->getRepository(Channel::class)->findBy([
            'status' => 1,
        ]);

        return $this->render(':home:index-auth.html.twig', array(
            'allChannels' => $allChannels,
            'myChannels' => []
        ));
    }
}
