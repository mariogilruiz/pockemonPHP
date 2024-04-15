<?php

namespace App\Form;

use App\Entity\Debilidad;
use App\Entity\Pokemons;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'attr' => [
                    'placeholder' => 'introduce el nombre de tu pokemon',
                ],
                'label' => 'Nombre de pokemon'
            ])
            ->add('descripcion')
            ->add('imagen')
            ->add('codigo')
            ->add('debilidades', EntityType::class, [
                'class' => Debilidad::class,
                'choice_label' => 'nombre',
                'multiple' => true,
                'autocomplete' => true
            ])
            ->add('enviar', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemons::class,
        ]);
    }
}
