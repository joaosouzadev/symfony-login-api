<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ColaboradorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ColaboradorRepository::class)
 */
class Colaborador
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instituicao", inversedBy="colaboradores")
     * @ORM\JoinColumn()
     * @Groups({"instituicao:get"})
     */
    private $instituicao;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $funcao;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $cpf;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuncao(): ?string
    {
        return $this->funcao;
    }

    public function setFuncao(string $funcao): self
    {
        $this->funcao = $funcao;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getInstituicao(): ?Instituicao
    {
        return $this->instituicao;
    }

    public function setInstituicao(?Instituicao $instituicao): self
    {
        $this->instituicao = $instituicao;

        return $this;
    }
}
