<?php

namespace App\Form;

use App\Entity\Meta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('MetaKey',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('MetaValue',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('Widgets')
            ->add('userId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meta::class,
        ]);
    }
}
