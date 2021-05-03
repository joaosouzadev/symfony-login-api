<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TurmaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"turma:get"}},
 *     denormalizationContext={"groups"={"turma:post"}}
 * )
 * @ORM\Entity(repositoryClass=TurmaRepository::class)
 */
class Turma
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"turma:get"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instituicao", inversedBy="turmas")
     * @ORM\JoinColumn()
     * @Groups({"turma:post"})
     */
    private $instituicao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Curso", inversedBy="turmas")
     * @ORM\JoinColumn()
     * @Groups({"turma:get", "turma:post"})
     */
    private $curso;

    /**
     * @ORM\Column(type="string")
     * @Groups({"turma:get", "turma:post"})
     */
    private $nome;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"turma:get", "turma:post"})
     */
    private $horaInicio;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"turma:get", "turma:post"})
     */
    private $horaFim;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TurmaIntervalo", mappedBy="turma")
     */
    private $intervalos;

    public function __construct()
    {
        $this->intervalos = new ArrayCollection();
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

    public function getCurso(): ?Curso
    {
        return $this->curso;
    }

    public function setCurso(?Curso $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * @return Collection|TurmaIntervalo[]
     */
    public function getIntervalos(): Collection
    {
        return $this->intervalos;
    }

    public function addIntervalo(TurmaIntervalo $intervalo): self
    {
        if (!$this->intervalos->contains($intervalo)) {
            $this->intervalos[] = $intervalo;
            $intervalo->setTurma($this);
        }

        return $this;
    }

    public function removeIntervalo(TurmaIntervalo $intervalo): self
    {
        if ($this->intervalos->removeElement($intervalo)) {
            // set the owning side to null (unless already changed)
            if ($intervalo->getTurma() === $this) {
                $intervalo->setTurma(null);
            }
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

    public function getHoraInicio(): ?string
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(?string $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraFim(): ?string
    {
        return $this->horaFim;
    }

    public function setHoraFim(?string $horaFim): self
    {
        $this->horaFim = $horaFim;

        return $this;
    }
}
