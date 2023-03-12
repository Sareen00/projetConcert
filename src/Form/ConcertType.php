<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Concert;
use App\Entity\Playlist;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date',DateType::class,[
                    'widget' => 'choice',
                    'format' => 'dd/MM/yyyy'
            ])
            ->add('sartHour',TimeType::class,[
                'widget' => 'single_text',
                'html5' => true,
                'input' => 'datetime',
            ])
            ->add('endHour', TimeType::class,[
                'widget' => 'single_text',
                'html5' => true,
                'input' => 'datetime',
            ])
            ->add('room',EntityType::class,[
                'class' => Room::class,
                'choice_label' => 'id'
            ])
            ->add('artist',EntityType::class,[
                'class' => Artist::class,
                'choice_label' => 'groupName'
            ])
            ->add('playlist',EntityType::class,[
                'class' => Playlist::class,
                'choice_label' => 'id'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Concert::class,
        ]);
    }
}
