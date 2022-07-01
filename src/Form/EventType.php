<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Edition;
use App\Entity\Sponsor;

use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{

    public function __construct(Security $security) {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eventName',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
           ->add('eventEdition', EntityType::class, ['class' => Edition::class,
           'choice_label' => 'edition_name',
           'label' => 'Edition'],  null, array(
               'attr' => array(
                   'placeholder' => 'hereYourPlaceHolder'
               )
          ))
            ->add('eventLogo',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('eventHashtag',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('eventCashprize',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('eventStartDate', DateTimeType::class, [
                'widget' => 'single_text',
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                ],
            ])
            ->add('eventEndDate', DateTimeType::class, [
                'widget' => 'single_text',
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                ],
            ])
            ->add('eventIdSponsor', EntityType::class, ['class' => Sponsor::class,
            'choice_label' => 'sponsor_name',
            'multiple' => true,
            'label' => 'Sponsor(s)'],  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
           ->add('userId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
