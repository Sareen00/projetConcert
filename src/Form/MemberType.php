<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Member;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('memberLastname',TextType::class,[
                'label' => 'Nom'
            ])
            ->add('memberFirstname',TextType::class,[
                'label' => 'Prénom'
            ])
            ->add('picture', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false
            ])
            ->add('birthday',DateType::class,[
                    'widget' => 'choice',
                    'format' => 'dd/MM/yyyy'
            ])
            ->add('artist',EntityType::class,[
                'class' => Artist::class,
                'choice_label' => 'groupName'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
