<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Overlay;

use App\Repository\UserRepository;

use App\Repository\EventRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class OverlayType extends AbstractType
{

    public function __construct(Security $security)
    {
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
            ->add('OverlayAccess', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'pseudo',
                'required' => false,
                'multiple' => true,
                'query_builder' => function (UserRepository $userrepository) {
                    return $userrepository->createQueryBuilder('u')
                        ->where('u.id != :user_id AND u.email != :websocket')
                        ->setParameter('user_id', $this->security->getUser()->getId())
                        ->setParameter('websocket', 'websocket@artaic.fr')
                        ->orderBy('u.pseudo', 'ASC');
                },
                'label' => 'Pseudo'
            ], array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder'
                )
            ))
            ->add('OverlayOwner')
            ->add('currentEvent');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Overlay::class,
        ]);
    }
}
