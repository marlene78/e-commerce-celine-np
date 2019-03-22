<?php

namespace App\Form;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-02-27
 * Time: 19:27
 */


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'label' =>'Votre Nom'
            ])
            ->add('prenom', TextType::class,[
                'label'=>'Votre Prénom'
            ])
            ->add('email', TextType::class,[
                'label'=>'Votre Adresse Email'
            ])

            ->add('sujet',ChoiceType::class,[
                'choices'=>[
                    'Collections' => 'Collections',
                    'Création sur mesure' => 'Création sur mesure',
                    'Coaching'=>'Coaching'
                ],
                'expanded'=>false,
                'multiple'=>false
            ])
            ->add('message', TextareaType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
