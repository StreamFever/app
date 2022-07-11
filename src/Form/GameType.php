<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use App\Entity\Map;
use App\Entity\Status;
use App\Entity\Format;
use App\Entity\Overlay;
use App\Repository\OverlayRepository;

use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{

    public function __construct(Security $security) {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gameScoreTeamAlpha',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('gameScoreTeamBeta',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('gameStartDate', DateTimeType::class, [
                'widget' => 'single_text',
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                ],
            ])
            ->add('gameFormat', EntityType::class, ['class' => Format::class,
            'choice_label' => 'format_name',
            'label' => 'Format'], array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('gameStatus', EntityType::class, ['class' => Status::class,
            'choice_label' => 'status_name',
            'label' => 'Status'], array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('gameIdTeamAlpha', EntityType::class, ['class' => Team::class,
            'choice_label' => 'team_name',
            'label' => 'Equipe A'], array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('gameIdTeamBeta', EntityType::class, ['class' => Team::class,
            'choice_label' => 'team_name',
            'label' => 'Equipe B'], array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('gameIdMaps', EntityType::class, ['class' => Map::class,
            'choice_label' => 'map_name',
            'multiple' => true,
            'label' => 'Map'], array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
           ->add('userId')
           ->add('overlayId', EntityType::class, 
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
               ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
