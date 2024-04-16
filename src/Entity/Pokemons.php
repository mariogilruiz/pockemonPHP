<?php

namespace App\Entity;

use App\Repository\PokemonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonsRepository::class)]
class Pokemons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\Column]
    private ?int $codigo = null;

    /**
     * @var Collection<int, Debilidad>
     */
    #[ORM\ManyToMany(targetEntity: Debilidad::class, inversedBy: 'pokemons')]
    private Collection $debilidades;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipo = null;

    public function __construct()
    {
        $this->debilidades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return Collection<int, Debilidad>
     */
    public function getDebilidades(): Collection
    {
        return $this->debilidades;
    }

    public function addDebilidade(Debilidad $debilidade): static
    {
        if (!$this->debilidades->contains($debilidade)) {
            $this->debilidades->add($debilidade);
        }

        return $this;
    }

    public function removeDebilidade(Debilidad $debilidade): static
    {
        $this->debilidades->removeElement($debilidade);

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }
}
