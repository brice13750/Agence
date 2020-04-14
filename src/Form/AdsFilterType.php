<?php

namespace App\Form;

use App\Entity\Ads;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AdsFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('price', IntegerType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'placeholder' => 'Prix max'
            ]
        ])
        ->add('area', IntegerType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'placeholder' => 'Surface min'
            ]
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ads::class,
        ]);
    }
}
