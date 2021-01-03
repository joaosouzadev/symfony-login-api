<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserConfirmationController
{

    private $userRepository;
    private $em;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function __invoke(Request $req)
    {
        $body = json_decode($req->getContent(),true);

        if(!isset($body,$body['confirmationToken'])){
            throw new ParameterNotFoundException("confirmationToken");
        }

        $user = $this->userRepository->findOneBy(
            ['confirmationToken' => $body['confirmationToken']]
        );

        if(!$user){
            throw new NotFoundHttpException('Usuário não encontrado');
        }

        $user->setConfirmationToken(null);
        $user->setEnabled(true);
        $this->em->flush();

        return new JsonResponse(null,Response::HTTP_OK);
    }
}