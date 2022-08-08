<?php

namespace App\Form;

use App\Entity\Overlay;
use App\Entity\Widgets;
use App\Entity\LibWidgets;

use App\Repository\WidgetsRepository;

use App\Repository\OverlayRepository;
use Symfony\Component\Form\FormEvent;


use Symfony\Component\Form\FormEvents;
use App\Repository\LibWidgetsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;

class WidgetsType extends AbstractType
{

    private $security;

    public function __construct(Security $security, WidgetsRepository $widgetsRepository)
    {
        $this->security = $security;
        $this->widgetsRepository = $widgetsRepository;
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
            ->add(
                'WidgetId',
                EntityType::class,
                [
                    'class' => LibWidgets::class,
                    'choice_label' => 'libWidgetName',
                    'query_builder' => function (LibWidgetsRepository $librepository) {
                        return $librepository->createQueryBuilder('l')
                            ->orderBy('l.libWidgetName', 'ASC');
                    },
                ]
            )
            ->add(
                'overlay',
                EntityType::class,
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
                ]
            )
            // INFO: Lors de l'édition d'un widget, afficher "isTwoWidgets" si celui-ci est un widget de "deux widgets"
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
                // dd($data);
                if (!empty($data->getWidgetId())) {
                    if ($data->getWidgetId()->getLibWidgetId2() != null) {
                        $form->add('isTwoWidgets');
                    } else {
                        $form->setData(['isTwoWidgets' => 0]);
                    }
                }
            });

        // INFO: Lors de la création d'un widget, afficher "isTwoWidgets" si celui-ci est un widget de "deux widgets"
        // $builder->addEventListener(
        //     FormEvents::PRE_SUBMIT,
        //     function (FormEvent $event) {
        //         $idWidget = $event->getData()['WidgetId'];
        //         $idOverlay = $event->getData()['overlay'];
        //         $widget = $this->widgetsRepository->findOneBy(['id' => $idWidget, 'overlay' => $idOverlay]);
        //         if ($widget->getIsTwoWidgets()) {
        //             $event->getForm()->add('isTwoWidgets');
        //         } else {
        //             $event->getForm()->setData(['isTwoWidgets' => 0]);
        //         }
        //         // dd($widget);
        //     }
        // );
        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                if ($event->getData()['WidgetId'] == 1) {
                    $event->getForm()->add('isTwoWidgets');
                }
                // FIXME: Ca fonctionne mais ça ne redirige pas vers le formulaire et ça annule la création :/
                // dd($event->getForm());
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Widgets::class,
        ]);
    }
}
