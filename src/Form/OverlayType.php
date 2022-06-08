<?php

namespace App\Form;

use App\Entity\Overlay;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OverlayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('widgetName',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('widgetIdAlpha',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('widgetIdBeta',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('widgetVersionAlpha',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('widgetVersionBeta',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('widgetOwner', EntityType::class, ['class' => User::class,
            'choice_label' => 'username',
            'multiple' => false,
            'label' => 'Propriétaire'],  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('WidgetPermission', EntityType::class, ['class' => User::class,
            'choice_label' => 'username',
            'multiple' => true,
            'label' => 'Permission'],  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Overlay::class,
        ]);
    }
}
