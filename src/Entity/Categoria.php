<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'categorias')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Torneo $torneo = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genero $genero = null;

    #[ORM\Column(length: 32, unique: true)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $disputa = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTorneo(): ?Torneo
    {
        return $this->torneo;
    }

    public function setTorneo(?Torneo $torneo): static
    {
        $this->torneo = $torneo;

        return $this;
    }

    public function getGenero(): ?Genero
    {
        return $this->genero;
    }

    public function setGenero(?Genero $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): static
    {
        $this->createdAt = new \DateTimeImmutable('now');

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdateAt(): static
    {
        $this->updateAt = new \DateTimeImmutable('now');

        return $this;
    }

    public function getDisputa(): ?string
    {
        return $this->disputa;
    }

    public function setDisputa(?string $disputa): static
    {
        $this->disputa = $disputa;

        return $this;
    }
}
