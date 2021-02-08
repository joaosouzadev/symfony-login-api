<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResponsavelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ResponsavelRepository::class)
 */
class Responsavel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instituicao", inversedBy="responsaveis")
     * @ORM\JoinColumn()
     * @Groups({"instituicao:get"})
     */
    private $instituicao;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $parentesco;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $responsavelFinanceiro;

    /**
     * @ORM\ManyToMany(targetEntity="Aluno", inversedBy="responsaveis")
     * @ORM\JoinTable(
     *  name="responsavel_aluno",
     *  joinColumns={
     *      @ORM\JoinColumn(name="responsavel_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="aluno_id", referencedColumnName="id")
     *  }
     * )
     * @ORM\OrderBy({"nome" = "ASC"})
     */
    protected $alunos;

    public function __construct()
    {
        $this->alunos = new ArrayCollection();
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

    public function getParentesco(): ?string
    {
        return $this->parentesco;
    }

    public function setParentesco(string $parentesco): self
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    public function getResponsavelFinanceiro(): ?bool
    {
        return $this->responsavelFinanceiro;
    }

    public function setResponsavelFinanceiro(?bool $responsavelFinanceiro): self
    {
        $this->responsavelFinanceiro = $responsavelFinanceiro;

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

    /**
     * @return Collection|Aluno[]
     */
    public function getAlunos(): Collection
    {
        return $this->alunos;
    }

    public function addAluno(Aluno $aluno): self
    {
        if (!$this->alunos->contains($aluno)) {
            $this->alunos[] = $aluno;
        }

        return $this;
    }

    public function removeAluno(Aluno $aluno): self
    {
        $this->alunos->removeElement($aluno);

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
