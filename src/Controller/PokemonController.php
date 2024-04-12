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
}
