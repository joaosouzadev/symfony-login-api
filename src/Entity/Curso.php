<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"curso:get"}},
 *     denormalizationContext={"groups"={"curso:post"}}
 * )
 * @ORM\Entity(repositoryClass=CursoRepository::class)
 */
class Curso
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instituicao", inversedBy="cursos")
     * @ORM\JoinColumn()
     * @Groups({"instituicao:get"})
     */
    private $instituicao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Segmento", inversedBy="cursos")
     * @ORM\JoinColumn()
     * @Groups({"segmento:get"})
     */
    private $segmento;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"curso:get", "curso:post"})
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Turma", mappedBy="curso")
     */
    private $turmas;

    public function __construct()
    {
        $this->turmas = new ArrayCollection();
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

    public function getInstituicao(): ?Instituicao
    {
        return $this->instituicao;
    }

    public function setInstituicao(?Instituicao $instituicao): self
    {
        $this->instituicao = $instituicao;

        return $this;
    }

    /**
     * @return Collection|Turma[]
     */
    public function getTurmas(): Collection
    {
        return $this->turmas;
    }

    public function addTurma(Turma $turma): self
    {
        if (!$this->turmas->contains($turma)) {
            $this->turmas[] = $turma;
            $turma->setCurso($this);
        }

        return $this;
    }

    public function removeTurma(Turma $turma): self
    {
        if ($this->turmas->removeElement($turma)) {
            // set the owning side to null (unless already changed)
            if ($turma->getCurso() === $this) {
                $turma->setCurso(null);
            }
        }

        return $this;
    }

    public function getSegmento(): ?Segmento
    {
        return $this->segmento;
    }

    public function setSegmento(?Segmento $segmento): self
    {
        $this->segmento = $segmento;

        return $this;
    }
}
