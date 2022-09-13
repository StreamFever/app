<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Map;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gameStartDate')
            ->add('gameScoreTeamAlpha')
            ->add('gameScoreTeamBeta')
            ->add('gameName')
            ->add('gameIdTeamAlpha')
            ->add('gameIdTeamBeta')
            ->add('gameFormat')
            ->add('gameStatus')
            ->add('gameIdMaps')
            ->add('userId')
            ->add('overlayId')
            ->add('currentMap')
            ->add('currentEvent');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
