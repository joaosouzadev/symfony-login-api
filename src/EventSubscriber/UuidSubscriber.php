<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Curso;
use App\Entity\Segmento;
use App\Entity\Turma;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Uid\Uuid;

class UuidSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['cadastrou', EventPriorities::PRE_WRITE]
        ];
    }

    public function cadastrou(ViewEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (Request::METHOD_POST === $method) {
            $token = $this->tokenStorage->getToken();
            if (null === $token) {
                return;
            }

            if (!$entity instanceof Segmento && !$entity instanceof Curso && !$entity instanceof Turma) {
                return;
            }

            $entity->setUuid(Uuid::v4());
        }
    }

}