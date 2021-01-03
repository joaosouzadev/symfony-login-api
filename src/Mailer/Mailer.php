<?php

namespace App\Mailer;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function confirmationEmail(User $user) {

        $body = $this->twig->render('email/confirmation.html.twig', ['user' => $user]);

        $email = (new Email())
            ->from('testedevlaravel@gmail.com')
            ->to($user->getEmail())
            ->subject('Bem vindo!')
            ->text('Bem vindo!')
            ->html($body);

        $this->mailer->send($email);
    }
}