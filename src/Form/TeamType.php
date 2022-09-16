<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Flag;
use App\Entity\Game;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('teamLogo', FileType::class, [
                'label' => 'Logo team',

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
