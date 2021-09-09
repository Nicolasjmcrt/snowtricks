<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('caption', TextType::class, [
            'label' => 'Caption',
            'attr' => ['placeholder' => 'Enter the name of the trick']
        ])
            ->add('fileName', FileType::class, [
                'label' => 'Medias',
                'help' => 'If you want to post multiple medias, press the button as many times as needed',
                'attr' => ['placeholder' => 'nlqshckea']
            ]);
       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class
        ]);
    }
}
