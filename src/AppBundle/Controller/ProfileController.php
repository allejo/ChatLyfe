<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/profile")
 */
class ProfileController extends Controller
{
    /**
     * @Route("/", name="profile")
     */
    public function indexAction(Request $request)
    {
        return $this->render(':profile:index.html.twig');
    }

    /**
     * @Route("/delete", name="delete_user")
     */
    public function deleteUserAction(Request $request)
	{
	    $em = $this->getDoctrine()->getManager();
	    /** @var User $user */
        $user = $this->getUser();

		$deleteUserForm = $this->createFormBuilder([])
			->add('submit', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', [
                'label' => 'Delete',
            ])
			->add('cancel', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', [
				'label' => 'Cancel',
            ])
			->getForm()
		;

		$deleteUserForm->handleRequest($request);

        if ($deleteUserForm->isValid() && $deleteUserForm->isSubmitted()) {
            if ($deleteUserForm->get('cancel')->isClicked()) {
                return $this->redirectToRoute('homepage');
            }

            $user->setEnabled(false);

            $em->persist($user);
            $em->flush();

            // force manual logout of logged in user
            $this->get('security.token_storage')->setToken(null);
            $request->getSession()->invalidate();

            return $this->redirectToRoute('fos_user_security_logout');
        }

    	return $this->render(':profile:delete.html.twig', [
            'delete_account' => $deleteUserForm->createView(),
        ]);
    }
}
