<?php

namespace App\Form;

use App\Entity\Overlay;
use App\Entity\User;

use App\Repository\UserRepository;

use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class OverlayType extends AbstractType
{

    public function __construct(Security $security) {
        $this->security = $security;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('OverlayName',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('OverlayAccess', EntityType::class, ['class' => User::class,
            'choice_label' => 'pseudo',
            'multiple' => true,
            'query_builder' => function (UserRepository $userrepository) {
                return $userrepository->createQueryBuilder('u')
                    ->where('u.id != :user_id')
                    ->setParameter('user_id', $this->security->getUser()->getId())
                    ->orderBy('u.pseudo', 'ASC');
            },
            'label' => 'Pseudo'], array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
           ))
            ->add('OverlayOwner');
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Overlay::class,
        ]);
    }
}
