<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Overlay;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            //->add('roles')
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('userFirstName')
            ->add('userLastName')
            ->add('username')
            ->add('avatarURL')
            ->add('overlaysAllowed', EntityType::class, ['class' => Overlay::class,
            'choice_label' => 'widget_name',
            'multiple' => true,
            'label' => 'Widgets autorisés'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
