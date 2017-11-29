<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        if (!$user instanceof UserInterface) {
            return $this->render(':home:index-no-auth.html.twig', array(

            ));
        }

        return $this->render(':home:index-auth.html.twig', array(
            'allChannels' => [],
            'myChannels' => []
        ));
    }
}
