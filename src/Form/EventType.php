<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Game;
use App\Entity\Overlay;
use App\Repository\OverlayRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eventName')
            ->add('eventHashtag')
            ->add('eventLogo', FileType::class, [
                'label' => 'Logo event',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PNG or JPEG image',
                    ])
                ],
            ])
            ->add('eventSlots')
            ->add('eventCashprize')
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
            ->add('eventEdition')
            ->add('eventIdSponsor')
            ->add('userId')
            ->add('eventFormat')
            ->add(
                'overlayId',
                EntityType::class,
                [
                    'class' => Overlay::class,
                    'choice_label' => 'overlay_name',
                    'query_builder' => function (OverlayRepository $overlayrepository) {
                        return $overlayrepository->createQueryBuilder('o')
                            ->leftJoin('o.OverlayAccess', 'u1')
                            ->where('u1 = :id_user OR o.OverlayOwner = :id_user')
                            ->setParameter('id_user', $this->security->getUser()->getId())
                            ->orderBy('o.OverlayName', 'ASC');
                    },
                ]
            )
            ->add('eventAccess')
            ->add('socials')
            ->add(
                'currentGame',
                EntityType::class,
                [
                    'class' => Game::class,
                    'choice_label' => 'game_name',
                ]
            )
            ->add('nextGame', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'game_name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
