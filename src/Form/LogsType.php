<?php

namespace App\Form;

use App\Entity\Logs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('LogsTimestamp')
            ->add('LogsLevel')
            ->add('LogsText')
            ->add('LogsOverlay')
            ->add('LogsUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Logs::class,
        ]);
    }
}
