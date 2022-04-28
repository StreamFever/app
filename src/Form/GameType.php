<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use App\Entity\Map;
use App\Entity\StatusGame;
use App\Entity\FormatGame;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gameScoreAlpha')
            ->add('gameScoreBeta')
            ->add('gameTimeNext')
            ->add('gameFormat', EntityType::class, ['class' => FormatGame::class,
            'choice_label' => 'format_game_name',
            'label' => 'Format'])
            ->add('gameStatus', EntityType::class, ['class' => StatusGame::class,
            'choice_label' => 'status_game_name',
            'label' => 'Status'])
            ->add('gameIDTeamAlpha', EntityType::class, ['class' => Team::class,
            'choice_label' => 'team_name',
            'label' => 'Equipe A'])
            ->add('gameIDTeamBeta', EntityType::class, ['class' => Team::class,
            'choice_label' => 'team_name',
            'label' => 'Equipe B'])
            ->add('gameIDMaps', EntityType::class, ['class' => Map::class,
            'choice_label' => 'map_name',
            'multiple' => true,
            'label' => 'Map'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
