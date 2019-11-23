<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/send_email", methods={"GET"}, name="api_send_email")
     */
    public function sendMail(): Response
    {
        return new JsonResponse(['message' => 'package']);
    }
}