<?php

namespace App\Form;

use App\Entity\Widgets;
use App\Entity\Overlay;
use App\Entity\LibWidgets;

use App\Repository\LibWidgetsRepository;
use App\Repository\OverlayRepository;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Security\Core\Security;

class WidgetsType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('WidgetName',  null, array(
                'attr' => array(
                    'placeholder' => 'hereYourPlaceHolder',
                    'class' => 'required'
                )
           ))
            ->add('WidgetVisible', HiddenType::class, [
                'empty_data' => 0,
            ])
            ->add('WidgetId', EntityType::class, 
            [
                'class' => LibWidgets::class, 
                'choice_label' => 'libWidgetName',
                'query_builder' => function (LibWidgetsRepository $librepository) {
                    return $librepository->createQueryBuilder('l')
                        ->orderBy('l.libWidgetName', 'ASC');
                },
                ])
            ->add('overlay', EntityType::class, 
            [
                'class' => Overlay::class, 
                'choice_label' => 'overlay_name',
                'query_builder' => function (OverlayRepository $overlayrepository) {
                    return $overlayrepository->createQueryBuilder('o')
                    ->join('o.OverlayAccess', 'u1')
                    ->join('o.OverlayOwner', 'u2')
                    ->where('u1.id = :user_id OR u2.id = :user_id')
                    ->setParameter('user_id', $this->security->getUser()->getId())
                    ->orderBy('o.id', 'ASC');
                },
                ])
           ->add('isTwoWidgets')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Widgets::class,
        ]);
    }
}
