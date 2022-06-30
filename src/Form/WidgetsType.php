<?php

namespace App\Form;

use App\Entity\Widgets;
use App\Entity\Overlay;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WidgetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('WidgetName',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder',
                    'class' => 'required'
                )
           ))
            ->add('WidgetVisible', HiddenType::class, [
                'empty_data' => 0,
            ])
            ->add('WidgetIdAlpha',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('WidgetIdBeta',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('WidgetVersionAlpha',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('WidgetVersionBeta',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('overlay', EntityType::class, ['class' => Overlay::class,
            'choice_label' => 'overlay_name',
            'label' => 'Overlay'], array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Widgets::class,
        ]);
    }
}
