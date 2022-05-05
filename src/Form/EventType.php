<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Sponsor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eventName')
            ->add('eventEdition')
            ->add('eventLogo')
            ->add('eventHashtag')
            ->add('eventCashprize')
            ->add('eventCurrentPhase')
            ->add('eventStartDate')
            ->add('eventEndDate')
            ->add('eventIDSponsor', EntityType::class, ['class' => Sponsor::class,
            'choice_label' => 'sponsor_name',
            'multiple' => true,
            'label' => 'Role'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
