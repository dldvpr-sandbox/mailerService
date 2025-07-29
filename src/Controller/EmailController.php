<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class EmailController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/email', name: 'app_email')]
    public function index(MailerInterface $mailer): Response
    {
        $email = new TemplatedEmail();
        $email
            ->to(new Address('toto@gmail.com', 'titi'))
            ->subject('Test email')
            ->htmlTemplate('email/welcome.html.twig')
            ->context([
                'username' => 'titi'
            ])
            ->attachFromPath('images/ex1.png', 'image1.png', 'image/png');

        $mailer->send($email);

        return $this->render('email/index.html.twig', [
            'controller_name' => 'EmailController',
        ]);
    }
}
