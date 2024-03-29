<?php

namespace App\Form;

use App\Entity\Tissu;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TissuType extends AbstractType
{
   

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('picture',ImageType::class,[
                'required'=>true,
                'label'=>'Image'
            ])
            ->add('prix')
  
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tissu::class,
        ]);
    }
}
