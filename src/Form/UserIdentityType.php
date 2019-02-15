<?php

namespace App\Form;


use App\Entity\UserIdentity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserIdentityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone',TextType::class,['label' => 'Téléphone'])
            ->add('pays')
            ->add('region',TextType::class,['label' =>'Région'])
            ->add('departement',TextType::class, ['label' =>'Département'])
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')




         

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserIdentity::class,
        ]);
    }
}
