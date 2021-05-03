<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"curso:get", "segmento:get", "instituicao:get", "turma:get"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"curso:post", "turma:post"}}
 * )
 * @ORM\Entity(repositoryClass=CursoRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"instituicao.uuid": "exact", "nome": "exact"})
 */
class Curso
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"curso:get"})
     * @ApiProperty(identifier=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"curso:get", "curso:post"})
     * @ApiProperty(identifier=true)
     */
    private $uuid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instituicao", inversedBy="cursos")
     * @ORM\JoinColumn()
     * @Groups({"curso:get", "curso:post"})
     */
    private $instituicao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Segmento", inversedBy="cursos")
     * @ORM\JoinColumn()
     * @Groups({"curso:get", "curso:post"})
     */
    private $segmento;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"curso:get", "curso:post"})
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Turma", mappedBy="curso", cascade={"persist"})
     * @Groups({"curso:get", "curso:post", "turma:post"})
     * @MaxDepth(1)
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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
