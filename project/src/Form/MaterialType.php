<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MaterialType
 *
 * @package App\Form\MaterialType
 */
class MaterialType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom :',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Entrer le nom du materiel',
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'price',
                NumberType::class,
                [
                    'label' => 'Prix :',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Entrer le prix du materiel',
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'category',
                TextType::class,
                [
                    'label' => 'Catégorie :',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Entrer la catégorie  du materiel',
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'reference',
                TextType::class,
                [
                    'label' => 'Référence :',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Entrer la référence  du materiel',
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'save',
                ButtonType::class,
                [
                    'label' => 'Save',
                    'attr' => [
                        'class' => 'mb-2 mr-2 btn btn-primary btn-block btn-save',
                        'style' => 'margin-top: 2%'
                    ]
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array());
    }
}
