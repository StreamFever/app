<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Team;
use App\Entity\Flag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('playerName',  null, array(
        'attr' => array(
            'placeholder' => 'hereYourPlaceHolder'
        ),
        ))
            ->add('playerAvatar', FileType::class, [
                'label' => 'Avatar player',

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
            ->add('playerUplay',  null, array(
        'attr' => array(
            'placeholder' => 'hereYourPlaceHolder'
        ),
        ))
        //     ->add('playerUplayTag',  null, array(
        // 'attr' => array(
        //     'placeholder' => 'hereYourPlaceHolder'
        // ),
        // ))
            ->add('playerAtTwitter',  null, array(
        'attr' => array(
            'placeholder' => 'hereYourPlaceHolder'
        ),
        ))
            ->add('playerDiscord',  null, array(
        'attr' => array(
            'placeholder' => 'hereYourPlaceHolder'
        ),
        ))
            ->add('playerTwitch',  null, array(
        'attr' => array(
            'placeholder' => 'hereYourPlaceHolder'
        ),
        ))
            ->add('playerStudentSa',  null, array(
        'attr' => array(
            'placeholder' => 'hereYourPlaceHolder'
        ),
        ))
            // ->add('playerIdOBSNinja')
            // ->add('playerIDTeam', EntityType::class, ['class' => Team::class,
            // 'choice_label' => 'team_name',
            // 'multiple' => true,
            // 'label' => 'Equipe'])
            // ->add('playerIDFlag', EntityType::class, ['class' => Flag::class,
            // 'choice_label' => 'flag_name',
            // 'label' => 'Pays'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
