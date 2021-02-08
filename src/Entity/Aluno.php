<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AlunoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AlunoRepository::class)
 */
class Aluno
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instituicao", inversedBy="alunos")
     * @ORM\JoinColumn()
     * @Groups({"aluno:get"})
     */
    private $instituicao;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $cpf;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dataNascimento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $responsavelProprio;

    /**
     * @ORM\ManyToMany(targetEntity="Responsavel", mappedBy="alunos")
     */
    protected $responsaveis;

    public function __construct()
    {
        $this->responsaveis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(?\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getResponsavelProprio(): ?bool
    {
        return $this->responsavelProprio;
    }

    public function setResponsavelProprio(?bool $responsavelProprio): self
    {
        $this->responsavelProprio = $responsavelProprio;

        return $this;
    }

    /**
     * @return Collection|Responsavel[]
     */
    public function getResponsaveis(): Collection
    {
        return $this->responsaveis;
    }

    public function addResponsavei(Responsavel $responsavei): self
    {
        if (!$this->responsaveis->contains($responsavei)) {
            $this->responsaveis[] = $responsavei;
            $responsavei->addAluno($this);
        }

        return $this;
    }

    public function removeResponsavei(Responsavel $responsavei): self
    {
        if ($this->responsaveis->removeElement($responsavei)) {
            $responsavei->removeAluno($this);
        }

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
