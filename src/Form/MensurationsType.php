<?php

namespace App\Form;

use App\Entity\Mensurations;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MensurationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('taille')
            ->add('tourDePoitrine')
            ->add('tourDeHanche')
            ->add('tourDeTaille')
            ->add('tourDeCuisse')

       
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mensurations::class,
        ]);
    }
}
