<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"post"},
 *     normalizationContext={"groups"={"user:get"}},
 *     denormalizationContext={"groups"={"user:post"}}
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:get"})
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $senha;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user:post"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user:get"})
     */
    private $createdAt;

    /**
     * @var \Doctrine\Common\Collections\Collection|Instituicao[]
     *
     * @ORM\ManyToMany(targetEntity="Instituicao", inversedBy="usuarios")
     * @ORM\JoinTable(
     *  name="user_instituicao",
     *  joinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="instituicao_id", referencedColumnName="id")
     *  }
     * )
     * @ORM\OrderBy({"razaoSocial" = "ASC"})
     */
    protected $instituicoes;

    public function __construct()
    {
        $this->instituicoes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        return $roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getPassword()
    {
        return $this->senha;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken($confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Instituicao[]
     */
    public function getInstituicoes(): Collection
    {
        return $this->instituicoes;
    }

    public function addInstituicao(Instituicao $instituicao): self
    {
        if (!$this->instituicoes->contains($instituicao)) {
            $this->instituicoes[] = $instituicao;
        }

        return $this;
    }

    public function removeInstituicao(Instituicao $instituicao): self
    {
        $this->instituicoes->removeElement($instituicao);

        return $this;
    }

    public function addInstituico(Instituicao $instituico): self
    {
        if (!$this->instituicoes->contains($instituico)) {
            $this->instituicoes[] = $instituico;
        }

        return $this;
    }

    public function removeInstituico(Instituicao $instituico): self
    {
        $this->instituicoes->removeElement($instituico);

        return $this;
    }
}
