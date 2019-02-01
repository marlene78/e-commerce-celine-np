<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-01-31
 * Time: 19:37
 */

namespace App\Form;


use App\Entity\Finitions;
use App\Entity\ModelBas;
use App\Entity\ModelHaut;
use App\Entity\Tissu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;


class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('modelHaut', EntityType::class,[
            'class'=> ModelHaut::class,
            'placeholder'=> 'Choisi ton modèle haut',
            'mapped' => false,
            'label' => 'Modéle Haut'
        ]);


        /**
         * Ajoute un champ tissu
         * @param FormInterface $form
         * @param ModelHaut|null $modelHaut
         */
        $formTissu = function (FormInterface $form, ModelHaut $modelHaut = null)
        {
            $tissu = null === $modelHaut ? [] : $modelHaut;

            $form->add('tissu', EntityType::class,[
                'class' => Tissu::class,
                'choices' => $modelHaut->getTissu(),
                'mapped' => false,
                'placeholder' => 'Fais ton choix'
            ]);
        };

        $builder->get('modelHaut')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($formTissu){
                $modelHaut = $event->getForm()->getData();
              $formTissu($event->getForm()->getParent(), $modelHaut);
            }
        );



    }














































}