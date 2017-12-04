<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/chats")
 */
class ChatController extends Controller
{
    /**
     * @Route("/{id}", name="view_chat")
     *
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $chat = $em->getRepository('AppBundle:Chat')->find($id);
        $messages = $em->getRepository('AppBundle:Message')->findMessagesInChannel($id);
        $users = $em->getRepository('AppBundle:User')->findUsersInChannel($id);
        $form = $this->createForm('AppBundle\Form\MessageFormType');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Message $message */
            $message = $form->getData();
            $message
                ->setAuthor($this->getUser())
                ->setChat($chat)
            ;

            $em->persist($message);
            $em->flush();
        }

        return $this->render(':chat:view.html.twig', [
            'chat' => $chat,
            'messages' => $messages,
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }
}
