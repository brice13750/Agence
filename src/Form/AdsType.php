<?php

namespace App\Form;

use App\Entity\Ads;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', FileType::class,[
                'label' => 'Photos'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('Title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('area', IntegerType::class,[
                'label' => 'Surface'
            ])
            ->add('rooms', IntegerType::class,[
                'label' => 'Nombre de pièces'
            ])
            ->add('bedrooms', IntegerType::class,[
                'label' => 'Nombre de chambres'
            ])
            ->add('floor', ChoiceType::class,[
                'label' => 'Étage',
                'choices' => [
                    'Rez-de-chausée' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ]
            ])
            ->add('price', NumberType::class,[
                'label' => 'Prix'
            ])
            ->add('type', ChoiceType::class,[
                'label' => 'Type',
                'choices' => [
                    'Appartement' => 'Appartement',
                    'Maison' => 'Maison',
                    'Chalet' => 'Chalet'
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
