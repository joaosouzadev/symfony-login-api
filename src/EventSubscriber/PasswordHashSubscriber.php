<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use App\Mailer\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordHashSubscriber implements EventSubscriberInterface {

    private $passwordEncoder;
    private $mailer;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, Mailer $mailer)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['hashPassword', EventPriorities::PRE_WRITE]
        ];
    }

    public function hashPassword(ViewEvent $event) {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User || !in_array($method, [Request::METHOD_POST, Request::METHOD_PUT])) {
            return;
        }

//        $user->setCreatedAt(new \DateTime());
        $user->setSenha($this->passwordEncoder->encodePassword($user, $user->getSenha()));
        $user->setConfirmationToken(bin2hex(random_bytes(30)));

        $this->mailer->confirmationEmail($user);
    }
}