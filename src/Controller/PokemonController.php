<?php

namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemons;
use App\Form\PokemonType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $debilidades = new Debilidad();
        $debilidades->setNombre('Veneno');
        $debilidades2 = new Debilidad();
        $debilidades2->setNombre('Fuego');
        $debilidades3 = new Debilidad();
        $debilidades3->setNombre('Agua');
        $pokemon->addDebilidade($debilidades3);
        $pokemon2->addDebilidade($debilidades);
        $pokemon2->addDebilidade($debilidades2);
        $doctrine->persist($debilidades);
        $doctrine->persist($debilidades2);
        $doctrine->persist($debilidades3);
        $doctrine->persist($pokemon);
        $doctrine->persist($pokemon2);
        $doctrine->persist($pokemon3);
        $doctrine->flush();

        return new Response('¡Pokemon añadidos correctamente!');
    }
    #[Route('/new/pokemon', name: "newPokemon")]
    public function newPokemon(EntityManagerInterface $doctrine, Request $request)
    {
        $form = $this->createForm(PokemonType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon = $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();
            $this->addFlash('Éxito', 'Pokemon guardado correctamente');
            return $this->redirectToRoute("listPokemon");
        }

        return $this->render('pokemon/newPokemon.html.twig', ['pokemonForm' => $form]);
    }
    #[Route('/edit/pokemon/{id}', name: "editPokemon")]
    public function editPokemon($id, EntityManagerInterface $doctrine, Request $request)
    {
        $repositorio = $doctrine->getRepository(Pokemons::class);

        $pokemon = $repositorio->find($id);

        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon = $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();
            // $this->addFlash('Éxito', 'Pokemon guardado correctamente');
            return $this->redirectToRoute("listPokemon");
        }

        return $this->render('pokemon/newPokemon.html.twig', ['pokemonForm' => $form]);
    }
    #[Route('/delete/pokemon/{id}', name: "deletePokemon")]
    public function deletePokemon($id, EntityManagerInterface $doctrine, Request $request)
    {
        $repositorio = $doctrine->getRepository(Pokemons::class);

        $pokemon = $repositorio->find($id);
        $doctrine->remove($pokemon);
        $doctrine->flush();
        return $this->redirectToRoute('listPokemon');
    }
}
