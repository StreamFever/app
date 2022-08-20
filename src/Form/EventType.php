<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Edition;
use App\Entity\Game;
use App\Entity\Sponsor;
use App\Entity\Social;

use App\Entity\Overlay;
use App\Repository\GameRepository;
use App\Repository\OverlayRepository;

use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class EventType extends AbstractType
{

    public function __construct(Security $security)
    {
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
            ->add('eventEdition', EntityType::class, [
                'class' => Edition::class,
                'choice_label' => 'edition_name',
                'label' => 'Edition'
            ],  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
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
            ->add('eventIdSponsor', EntityType::class, [
                'class' => Sponsor::class,
                'choice_label' => 'sponsor_name',
                'multiple' => true,
                'label' => 'Sponsor(s)'
            ],  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            //    ->add('eventSocial', EntityType::class, ['class' => Social::class,
            //     // 'choice_label' => 'social_lib_id',
            //     'multiple' => true,
            //     'label' => 'Réseaux sociaux'],  null, array(
            //         'attr' => array(
            //             'placeholder' => 'hereYourPlaceHolder'
            //         )
            //    ))
            ->add('eventSlots',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('userId')
            ->add('eventAccess')
            ->add('eventFormat',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add(
                'overlayId',
                EntityType::class,
                [
                    'class' => Overlay::class,
                    'choice_label' => 'overlay_name',
                    'query_builder' => function (OverlayRepository $overlayrepository) {
                        return $overlayrepository->createQueryBuilder('o')
                            ->join('o.OverlayAccess', 'u1')
                            ->join('o.OverlayOwner', 'u2')
                            ->where('u1.id = :user_id OR u2.id = :user_id')
                            ->setParameter('user_id', $this->security->getUser()->getId())
                            ->orderBy('o.id', 'ASC');
                    },
                ]
            )
            ->add(
                'currentGame',
                EntityType::class,
                [
                    'class' => Game::class,
                    'choice_label' => 'game_name',
                ]
            )
            ->add('socials');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
