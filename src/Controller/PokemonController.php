<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{

    #[Route('/pokemon')]
    public function showPokemon()
    {

        $pokemon = [
            'nombre' => 'pikachu',
            'descripcion' => 'electrico',
            'imagen' => 'https://images.wikidexcdn.net/mwuploads/wikidex/thumb/7/77/latest/20150621181250/Pikachu.png/800px-Pikachu.png',
            'codigo' => '23456'
        ];

        return $this->render('pokemon/showPokemon.html.twig', ['pokemon' => $pokemon]);
    }

    #[Route('/pokemons')]
    public function listPokemon()
    {

        $pokemons = [
            [
                'nombre' => 'pikachu',
                'descripcion' => 'electrico',
                'imagen' => 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png',
                'codigo' => '23456'
            ],
            [
                'nombre' => 'toggepi',
                'descripcion' => 'psíquico',
                'imagen' => 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/028.png',
                'codigo' => '23457'
            ],
            [
                'nombre' => 'squirtle',
                'descripcion' => 'agua',
                'imagen' => 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/021.png',
                'codigo' => '23458'
            ]
        ];

        return $this->render('pokemon/listPokemon.html.twig', ['pokemons' => $pokemons]);
    }
}
