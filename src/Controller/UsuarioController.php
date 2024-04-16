<?php

namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemons;
use App\Form\PokemonType;
use App\Form\UsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{

    #[Route('/new/usuario', name: "newusuario")]
    public function newUsuario(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher)
    {
        $form = $this->createForm(UsuarioType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $usuario = $form->getData();
            $password = $usuario->getPassword();
            $passwordcifrada = $hasher->hashPassword($usuario, $password);
            $usuario->setPassword($passwordcifrada);
            $doctrine->persist($usuario);
            $doctrine->flush();
            $this->addFlash('Éxito', 'Usuario guardado correctamente');
            return $this->redirectToRoute("listPokemon");
        }

        return $this->render('pokemon/newPokemon.html.twig', ['pokemonForm' => $form]);
    }

    #[Route('/new/adm', name: "newadm")]
    public function newAdm(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher)
    {
        $form = $this->createForm(UsuarioType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $usuario = $form->getData();
            $password = $usuario->getPassword();
            $passwordcifrada = $hasher->hashPassword($usuario, $password);
            $usuario->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
            $usuario->setPassword($passwordcifrada);
            $doctrine->persist($usuario);
            $doctrine->flush();
            $this->addFlash('Éxito', 'Usuario guardado correctamente');
            return $this->redirectToRoute("listPokemon");
        }

        return $this->render('pokemon/newPokemon.html.twig', ['pokemonForm' => $form]);
    }
}
