<?php

namespace App\Form;

use App\Entity\Meta;
use App\Entity\Widgets;

use App\Repository\WidgetsRepository;

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
                    'placeholder' => 'hereYourPlaceHolder',
                    'id' => 'test'
                ),

            ))
            ->add('MetaValue',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder',
                    'id' => 'test'
                )
            ))
            ->add('Widgets')
            ->add('userId');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meta::class,
        ]);
    }
}
