<?php

namespace App\Form;

use App\Entity\Jeu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class JeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('imageFile', FileType::class, [
            'required' => false,
            'label' => 'Image du jeu',
        ])
            ->add('description')
            ->add('plateforme', ChoiceType::class, [
            'choices' => [
                'PC' => 'pc',
                'PlayStation5' => 'playstation5',
                'Xbox' => 'xbox',
                'Nintendo Switch' => 'nintendo_switch',
                // ajoutez d'autres plateformes selon le besoin
            ],
        ])
            ->add('prix')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
        ]);
    }

}
