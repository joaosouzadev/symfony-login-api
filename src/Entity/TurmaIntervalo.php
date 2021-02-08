<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TurmaIntervaloRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"turmaIntervalo:get"}},
 *     denormalizationContext={"groups"={"turmaIntervalo:post"}}
 * )
 * @ORM\Entity(repositoryClass=TurmaIntervaloRepository::class)
 */
class TurmaIntervalo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Turma", inversedBy="intervalos")
     * @ORM\JoinColumn()
     * @Groups({"turma:get"})
     */
    private $turma;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"turmaIntervalo:get", "turmaIntervalo:post"})
     */
    private $inicio;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"turmaIntervalo:get", "turmaIntervalo:post"})
     */
    private $fim;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInicio(): ?string
    {
        return $this->inicio;
    }

    public function setInicio(string $inicio): self
    {
        $this->inicio = $inicio;

        return $this;
    }

    public function getFim(): ?string
    {
        return $this->fim;
    }

    public function setFim(string $fim): self
    {
        $this->fim = $fim;

        return $this;
    }

    public function getTurma(): ?Turma
    {
        return $this->turma;
    }

    public function setTurma(?Turma $turma): self
    {
        $this->turma = $turma;

        return $this;
    }
}
