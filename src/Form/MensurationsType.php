<?php

namespace App\Form;

use App\Entity\Mensurations;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MensurationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('taille',TextType::class,[
               'label' =>'Taille (cm)'
           ])
            ->add('tourDePoitrine')
            ->add('tourDeHanche',TextType::class,[
               'label'=> 'Tour de poitrine (cm)'
           ])
            ->add('tourDeTaille',TextType::class,[
               'label'=> 'Tour de taille (cm)'
           ])
            ->add('tourDeCuisse',TextType::class,[
               'label' => 'Tour de cuisse (cm)'
           ])

       
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mensurations::class,
        ]);
    }
}
