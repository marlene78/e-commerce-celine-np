<?php

namespace App\Form;

use App\Entity\Accessoires;
use App\Entity\Commande;
use App\Entity\Finitions;
use App\Entity\ModelBas;
use App\Entity\ModelHaut;
use App\Entity\Tissu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('id')
            ->add('modeleHaut', EntityType::class,[
                'expanded' =>true,
                'multiple' => false,
                'class' =>ModelHaut::class,

            ])
            ->add('tissuHaut',EntityType::class,[
                'expanded' =>true,
                'multiple' => false,
                'class' =>Tissu::class
            ])

            ->add('finitionHaut',EntityType::class,[
                'expanded' =>true,
                'multiple' => false,
                'class' =>Finitions::class
            ])


            ->add('modeleBas',EntityType::class,[
                'expanded' =>true,
                'multiple' => false,
                'class' =>ModelBas::class
            ])

            ->add('tissuBas',EntityType::class,[
                'expanded' =>true,
                'multiple' => false,
                'class' =>Tissu::class
            ])

            ->add('finitionBas',EntityType::class,[
                'expanded' =>true,
                'multiple' => false,
                'class' =>Finitions::class
            ])




            ->add('accessoire',EntityType::class,[
                'expanded' =>true,
                'multiple' => false,
                'class' =>Accessoires::class
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
