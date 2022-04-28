<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userFirstName')
            ->add('userLastName')
            ->add('userPseudo')
            ->add('userEmail')
            ->add('userPassword')
            ->add('userToken')
            ->add('userRole', EntityType::class, ['class' => Role::class,
            'choice_label' => 'role_name',
            'label' => 'Role'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
