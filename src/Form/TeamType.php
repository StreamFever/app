<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Flag;
use App\Entity\Game;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('teamName',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('teamLogo',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            // ->add('teamIDFlag', EntityType::class, ['class' => Flag::class,
            // 'choice_label' => 'flag_name',
            // 'label' => 'Pays'])
            ->add('players', EntityType::class, ['class' => Player::class,
            'choice_label' => 'player_name',
            'multiple' => true,
            'label' => 'Player'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
