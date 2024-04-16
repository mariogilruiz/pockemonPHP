<?php

namespace App\DataFixtures;

use App\Entity\Pokemons;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Faker\Factory;

class PokemonFixtures extends Fixture
{
    protected $client;
    protected $faker;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=100; $i++){
            $codPokemon = $this->faker->numberBetween(100, 999);

            $response = $this->client->request("GET", "https://pokeapi.co/api/v2/pokemon/$codPokemon");
            $pokeData = $response->toArray();

            $pokemon = new Pokemons();
            $pokemon->setNombre(ucfirst($pokeData['name']));
            $pokemon->setDescripcion($this->faker->sentence);
            $pokemon->setImagen("https://assets.pokemon.com/assets/cms2/img/pokedex/full/$codPokemon.png");
            $pokemon->setCodigo($codPokemon);

            $manager->persist($pokemon);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
