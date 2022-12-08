<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Repository\ConversationRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/messages", name="app_message")
 */
class MessageController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    public function __construct(EntityManagerInterface $entityManager, MessageRepository $messageRepository)
    {

        $this->entityManager = $entityManager;
        $this->messageRepository = $messageRepository;
    }

    /**
     * @Route("/{id}", name="getMessages")
     * @param Request $request
     * @param Conversation $conversation
     * @return Response
     */
    public function index(Request $request, Conversation $conversation)
    {
        $this->denyAccessUnlessGranted('view', $conversation);

        $messages = $this->messageRepository->findMessagesByConversationId(
            $conversation->getId()
        );
        array_map($messages as $message) {

    }
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }
}
