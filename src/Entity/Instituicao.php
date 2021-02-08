<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InstituicaoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *      "get"={"path"="instituicoes"},
 *      "post"={"path"="instituicoes"}
 *     },
 *     itemOperations={
 *      "get"={"path"="instituicoes/{id}"},
 *      "put"={"path"="instituicoes/{id}"},
 *      "delete"={"path"="instituicoes/{id}"}
 *     },
 *     normalizationContext={"groups"={"instituicao:get"}},
 *     denormalizationContext={"groups"={"instituicao:post"}}
 * )
 * @ORM\Entity(repositoryClass=InstituicaoRepository::class)
 * @UniqueEntity(fields="cnpj", message="Este cnpj já está cadastrado.")
 */
class Instituicao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"instituicao:get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"instituicao:get", "instituicao:post"})
     */
    private $cnpj;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"instituicao:get", "instituicao:post"})
     */
    private $razaoSocial;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"instituicao:get", "instituicao:post"})
     */
    private $nomeFantasia;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="instituicoes")
     */
    protected $usuarios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Segmento", mappedBy="instituicao")
     */
    protected $segmentos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Curso", mappedBy="instituicao")
     */
    protected $cursos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Turma", mappedBy="instituicao")
     */
    protected $turmas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Materia", mappedBy="instituicao")
     */
    protected $materias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aluno", mappedBy="instituicao")
     */
    protected $alunos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Responsavel", mappedBy="instituicao")
     */
    protected $responsaveis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Colaborador", mappedBy="instituicao")
     */
    protected $colaboradores;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
        $this->segmentos = new ArrayCollection();
        $this->cursos = new ArrayCollection();
        $this->alunos = new ArrayCollection();
        $this->responsaveis = new ArrayCollection();
        $this->colaboradores = new ArrayCollection();
        $this->materias = new ArrayCollection();
        $this->turmas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = preg_replace('/\D/', '', $cnpj);

        return $this;
    }

    public function getRazaoSocial(): ?string
    {
        return $this->razaoSocial;
    }

    public function setRazaoSocial(string $razaoSocial): self
    {
        $this->razaoSocial = $razaoSocial;

        return $this;
    }

    public function getNomeFantasia(): ?string
    {
        return $this->nomeFantasia;
    }

    public function setNomeFantasia(string $nomeFantasia): self
    {
        $this->nomeFantasia = $nomeFantasia;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(User $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            $usuario->addInstituico($this);
        }

        return $this;
    }

    public function removeUsuario(User $usuario): self
    {
        if ($this->usuarios->removeElement($usuario)) {
            $usuario->removeInstituico($this);
        }

        return $this;
    }

    /**
     * @return Collection|Curso[]
     */
    public function getCursos(): Collection
    {
        return $this->cursos;
    }

    public function addCurso(Curso $curso): self
    {
        if (!$this->cursos->contains($curso)) {
            $this->cursos[] = $curso;
            $curso->setInstituicao($this);
        }

        return $this;
    }

    public function removeCurso(Curso $curso): self
    {
        if ($this->cursos->removeElement($curso)) {
            // set the owning side to null (unless already changed)
            if ($curso->getInstituicao() === $this) {
                $curso->setInstituicao(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Segmento[]
     */
    public function getSegmentos(): Collection
    {
        return $this->segmentos;
    }

    public function addSegmento(Segmento $segmento): self
    {
        if (!$this->segmentos->contains($segmento)) {
            $this->segmentos[] = $segmento;
            $segmento->setInstituicao($this);
        }

        return $this;
    }

    public function removeSegmento(Segmento $segmento): self
    {
        if ($this->segmentos->removeElement($segmento)) {
            // set the owning side to null (unless already changed)
            if ($segmento->getInstituicao() === $this) {
                $segmento->setInstituicao(null);
            }
        }

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
            $turma->setInstituicao($this);
        }

        return $this;
    }

    public function removeTurma(Turma $turma): self
    {
        if ($this->turmas->removeElement($turma)) {
            // set the owning side to null (unless already changed)
            if ($turma->getInstituicao() === $this) {
                $turma->setInstituicao(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Materia[]
     */
    public function getMaterias(): Collection
    {
        return $this->materias;
    }

    public function addMateria(Materia $materia): self
    {
        if (!$this->materias->contains($materia)) {
            $this->materias[] = $materia;
            $materia->setInstituicao($this);
        }

        return $this;
    }

    public function removeMateria(Materia $materia): self
    {
        if ($this->materias->removeElement($materia)) {
            // set the owning side to null (unless already changed)
            if ($materia->getInstituicao() === $this) {
                $materia->setInstituicao(null);
            }
        }

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
            $aluno->setInstituicao($this);
        }

        return $this;
    }

    public function removeAluno(Aluno $aluno): self
    {
        if ($this->alunos->removeElement($aluno)) {
            // set the owning side to null (unless already changed)
            if ($aluno->getInstituicao() === $this) {
                $aluno->setInstituicao(null);
            }
        }

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
            $responsavei->setInstituicao($this);
        }

        return $this;
    }

    public function removeResponsavei(Responsavel $responsavei): self
    {
        if ($this->responsaveis->removeElement($responsavei)) {
            // set the owning side to null (unless already changed)
            if ($responsavei->getInstituicao() === $this) {
                $responsavei->setInstituicao(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Colaborador[]
     */
    public function getColaboradores(): Collection
    {
        return $this->colaboradores;
    }

    public function addColaboradore(Colaborador $colaboradore): self
    {
        if (!$this->colaboradores->contains($colaboradore)) {
            $this->colaboradores[] = $colaboradore;
            $colaboradore->setInstituicao($this);
        }

        return $this;
    }

    public function removeColaboradore(Colaborador $colaboradore): self
    {
        if ($this->colaboradores->removeElement($colaboradore)) {
            // set the owning side to null (unless already changed)
            if ($colaboradore->getInstituicao() === $this) {
                $colaboradore->setInstituicao(null);
            }
        }

        return $this;
    }
}
