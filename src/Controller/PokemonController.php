<?php

namespace App\Controller;

use App\Entity\Pokemons;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{

    #[Route('/pokemon/{id}', name: "showPokemon")]
    public function showPokemon(EntityManagerInterface $doctrine, $id)
    {

        $repositorio = $doctrine->getRepository(Pokemons::class);

        $pokemon = $repositorio->find($id);

        return $this->render('pokemon/showPokemon.html.twig', ['pokemon' => $pokemon]);
    }

    #[Route('/pokemons', name: "listPokemon")]
    public function listPokemon(EntityManagerInterface $doctrine)
    {

        $repositorio = $doctrine->getRepository(Pokemons::class);

        $pokemons = $repositorio->findAll();

        return $this->render('pokemon/listPokemon.html.twig', ['pokemons' => $pokemons]);
    }
    #[Route('/insert/pokemon')]
    public function insertPokemon(EntityManagerInterface $doctrine)
    {
        $pokemon = new Pokemons();
        $pokemon->setNombre('pikachu');
        $pokemon->setDescripcion('electrico');
        $pokemon->setImagen('https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png');
        $pokemon->setCodigo(23456);
        $pokemon2 = new Pokemons();
        $pokemon2->setNombre('togepi');
        $pokemon2->setDescripcion('psíquico');
        $pokemon2->setImagen('https://assets.pokemon.com/assets/cms2/img/pokedex/full/175.png');
        $pokemon2->setCodigo(23457);
        $pokemon3 = new Pokemons();
        $pokemon3->setNombre('squirtle');
        $pokemon3->setDescripcion('agua');
        $pokemon3->setImagen('https://assets.pokemon.com/assets/cms2/img/pokedex/full/007.png');
        $pokemon3->setCodigo(23458);
        $doctrine->persist($pokemon);
        $doctrine->persist($pokemon2);
        $doctrine->persist($pokemon3);
        $doctrine->flush();
        return new Response('¡Pokemon añadidos correctamente!');
    }
}
