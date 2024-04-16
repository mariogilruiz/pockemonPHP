<?php

namespace App\DataFixtures;

use App\Entity\Debilidad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DebilidadFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $debilidades = [
            "Fuego",
            "Agua",
            "Veneno",
            "Psíquico",
            "Fantasma"
        ];

        foreach ($debilidades as $nomDebilidad) {
            $debilidad = new Debilidad();
            $debilidad->setNombre($nomDebilidad);

            $manager->persist($debilidad);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
