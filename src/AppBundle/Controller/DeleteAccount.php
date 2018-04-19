<?php

namespace AppBundle\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class DeleteAccount extends Controller
{
/**
 * @Route("settings/delete-user", name="delete-user")
 */
	
	
	public function deleteUserAction(Request $request)                               
	{
		$deleteUserForm = $this->createFormBuilder([])
			->add('submit', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', [
                'label' => 'Submit',
            ])
			->add('cancel', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', [
				'label' => 'Cancel',
            ])
			->getForm()
		;
			
		$user = $this->getUser();

		$deleteUserForm->handleRequest($request);

        if($deleteUserForm->isValid() && $deleteUserForm->isSubmitted()){

            // force manual logout of logged in user    
            $this->get('security.token_storage')->setToken(null);

            $em->remove($user);
            $em->flush();

            $session->invalidate(0);
    }
	
	return $this->render(':chat:create.html.twig', [
            'form' => $form->createView(),
        ]);
}
}