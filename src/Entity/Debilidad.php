<?php

namespace App\Entity;

use App\Repository\DebilidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DebilidadRepository::class)]
class Debilidad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Pokemons>
     */
    #[ORM\ManyToMany(targetEntity: Pokemons::class, mappedBy: 'debilidades')]
    private Collection $pokemons;

    public function __construct()
    {
        $this->pokemons = new ArrayCollection();
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

    /**
     * @return Collection<int, Pokemons>
     */
    public function getPokemons(): Collection
    {
        return $this->pokemons;
    }

    public function addPokemon(Pokemons $pokemon): static
    {
        if (!$this->pokemons->contains($pokemon)) {
            $this->pokemons->add($pokemon);
            $pokemon->addDebilidade($this);
        }

        return $this;
    }

    public function removePokemon(Pokemons $pokemon): static
    {
        if ($this->pokemons->removeElement($pokemon)) {
            $pokemon->removeDebilidade($this);
        }

        return $this;
    }
}
