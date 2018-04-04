<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Channel;
use AppBundle\Entity\Message;
use AppBundle\Entity\User;
use AppBundle\Form\ChatFormType;
use Pusher\Pusher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/chats")
 */
class ChatController extends Controller
{
    /**
     * @Route("/create", name="create_chat")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $form = $this->createForm(ChatFormType::class);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            /** @var Channel $chat */
            $chat = $form->getData();
            $chat->setOwner($user);
            $chat->setStatus(Channel::STATUS_ACTIVE);

            $em->persist($chat);
            $em->flush();

            return $this->redirectToRoute('view_chat', [
                'id' => $chat->getId(),
            ]);
        }

        return $this->render(':chat:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/view/{id}", name="view_chat")
     *
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $chat = $em->getRepository(Channel::class)->find($id);

        if ($chat === null) {
            throw $this->createNotFoundException('This chat does not exist');
        }

        if (!$this->getUser() instanceof UserInterface) {
            throw $this->createAccessDeniedException('You must be logged in to use this functionality.');
        }

        $form = $this->createForm('AppBundle\Form\MessageFormType');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Message $message */
            $message = $form->getData();
            $message
                ->setAuthor($this->getUser())
                ->setChat($chat)
            ;

            // Don't send out the message if it's an empty message
            $msg = trim($message->getMessage());
            if (empty($msg)) {
                return (new JsonResponse([
                    'status' => 'failed',
                ]));
            }

            $this->sendPusherEvent($message, $id);

            $em->persist($message);
            $em->flush();

            return (new JsonResponse([
                'status' => 'success',
            ]));
        }

        $messages = $em->getRepository(Message::class)->findMessagesInChannel($id);
        $users = $em->getRepository(User::class)->findUsersInChannel($id);

        return $this->render(':chat:view.html.twig', [
            'directMessage' => false,
            'chat' => $chat,
            'messages' => array_reverse($messages),
            'users' => $users,
            'form' => $form->createView(),
            'pusher' => [
                'key' => $this->getParameter('pusher_key'),
                'channel' => sprintf('chats_%d', $id),
            ],
        ]);
    }

/***************************************************************************/
/***************************************************************************/
/********make correct route for direct chat**************************/
    /*
     * @Route("/direct/{id}", name="create_directchat")
     *
     * @param Request $request
     *
     * @return Response
     */

public function createDirectaction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
/*******/
        $form = $this->createForm(DirectMessageFormType::class);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            /** @var DirectMessage $directMessage */
            $chat = $form->getData();
            $chat->setOwner($user);
            $chat->setStatus(Channel::STATUS_ACTIVE);

            $em->persist($chat);
            $em->flush();

            return $this->redirectToRoute('view_chat', [
                'id' => $chat->getId(),
            ]);
        }

        return $this->render(':chat:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

  

/******************Dont touch this one Kevin********************************/
/***************************************************************************/

    /**
     * Send a Pusher event to all connected clients on this channel.
     *
     * @param int $channelID
     */
    private function sendPusherEvent(Message $message, $channelID)
    {
        $data = [
            'message' => $this->renderView(':chat:message.html.twig', [
                'message' => $message,
            ])
        ];

        /** @var Pusher $pusher */
        $pusher = $this->get('pusher');
        $pusher->trigger(
            sprintf('chats_%d', $channelID),
            'message_sent',
            $data
        );
    }
}
