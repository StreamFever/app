<?php

namespace App\Form;

use App\Entity\Players;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('playerName')
            ->add('playerAvatar')
            ->add('playerUplay')
            ->add('playerAtTwitter')
            ->add('playerDiscord')
            ->add('playerTwitch')
            ->add('playerIsStudentSA')
            ->add('playerTeamID')
            ->add('playerIDFlag')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Players::class,
        ]);
    }
}
