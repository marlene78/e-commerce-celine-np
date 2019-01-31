<?php

namespace App\Form;

use App\Entity\Articles;

use App\Entity\Page;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu',CKEditorType::class, array(
            'config' => array(
            'uiColor' => '#ffffff',
                    //...
            ),
            ))

            ->add('picture',ImageType::class,[
             'required'=>false
         ])

           ->add('page', EntityType::class,[
               'class'=> Page::class,
             'choice_label' => 'titre'
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
