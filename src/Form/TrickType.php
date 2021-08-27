<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Trick',
            'attr' => ['placeholder' => 'Enter the name of the trick']
        ])
            ->add('description', TextareaType::class, [
                'label' => 'Trick description',
                'attr' => [
                    'placeholder' => 'Enter a description of the trick'
                ]
            ])
            ->add('trickMedia', CollectionType::class, [
                'label' => false,
                'help' => 'Add media for the trick',
                'entry_type' => MediaType::class,
                'entry_options' => [
                    'label' => false
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('videos', CollectionType::class, [
                'label' => 'Videos',
                'attr' => [
                    'placeholder' => 'Add a valid URL to put a video for the trick'
                ],
                'entry_type' => VideoType::class
            ])
            ->add('trickGroup', EntityType::class, [
            'label' => 'Group',
            'placeholder' => '-- Select a group --',
            'class' => Group::class,
            'choice_label' => function(Group $group){
                return strtoupper($group->getName());
            }
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
