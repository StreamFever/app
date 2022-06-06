<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Team;
use App\Entity\Flag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('playerName')
            ->add('playerAvatar')
            ->add('playerUplay')
            ->add('playerUplayTag')
            ->add('playerAtTwitter')
            ->add('playerDiscord')
            ->add('playerTwitch')
            ->add('playerStudentSA')
            ->add('playerIdOBSNinja')
            ->add('playerIDTeam', EntityType::class, ['class' => Team::class,
            'choice_label' => 'team_name',
            'multiple' => true,
            'label' => 'Equipe'])
            ->add('playerIDFlag', EntityType::class, ['class' => Flag::class,
            'choice_label' => 'flag_name',
            'label' => 'Pays'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
