<?php


namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Instituicao;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class InstituicaoSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;
    private $params;

    public function __construct(TokenStorageInterface $tokenStorage, ParameterBagInterface $params)
    {
        $this->tokenStorage = $tokenStorage;
        $this->params = $params;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['cadastrouInstituicao', EventPriorities::PRE_WRITE]
        ];
    }

    public function cadastrouInstituicao(ViewEvent $event)
    {
        $instituicao = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        $token = $this->tokenStorage->getToken();

        if (null === $token) {
            return;
        }

        $user = $token->getUser();

        if (!$instituicao instanceof Instituicao) {
            return;
        }

        if (Request::METHOD_POST === $method) {
            // usuario
            $user->addInstituicao($instituicao);

            // empresa
            $cnpj = $instituicao->getCnpj();

            if (!file_exists($this->params->get('uploads') . $cnpj . '/logo')) {
                mkdir($this->params->get('uploads') . $cnpj, 0777, true);
                mkdir($this->params->get('uploads') . $cnpj . '/logo', 0777, true);
            }

            if (!file_exists($this->params->get('data') . $cnpj)) {
                mkdir($this->params->get('data') . $cnpj, 0777, true);
                mkdir($this->params->get('data') . $cnpj . '/temp_folder', 0777, true);
            }
        } else {
            return;
        }
    }
}