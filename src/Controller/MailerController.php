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
    public function sendMail(\Swift_Mailer $swiftMailer, string $mail): Response
    {
//        $swiftMessage = (new \Swift_Message('Mam temacik dla Ciebie'))
//            ->setTo('morenequs@gmail.com', 'Patryk')
//            ->setFrom('azoomofficial@gmail.com', 'Polska Husaria')
//            ->setBody(
//                'No siemanko mordeczko<br>Może chciałbyś co nie co hehehe',
//                'text/html'
//            )
//        ;
//
//        $swiftMailer->send($swiftMessage);

        return new JsonResponse(['message' => $mail]);
    }
}