<?php

namespace App\Entity;

use App\Controller\UserConfirmationController;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "post"={
 *              "path"="/users/confirm",
 *              "controller"= UserConfirmationController::class,
 *          }
 *      },
 *      itemOperations={}
 * )
 */
class UserConfirmation {

    /**
     * @Assert\NotBlank();
     */
    public $confirmationToken;
}