<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Overlay;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('pseudo',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'tinymce'],
            ],  null, array(
                'attr' => array(
                    'placeholder' => 'Définissez un mot de passe'
                )
            ))
            ->add('userFirstName',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('userLastName',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('avatarURL', FileType::class, [
                'label' => 'Avatar User',

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
            // ->add('overlaysAllowed', EntityType::class, ['class' => Overlay::class,
            // 'choice_label' => 'widget_name',
            // 'multiple' => true,
            // 'label' => 'Widgets autorisés'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
