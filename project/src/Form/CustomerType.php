<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CustomerType
 *
 * @package App\Form\CustomerType
 */
class CustomerType extends AbstractType
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
                'firstName',
                TextType::class,
                [
                    'label' => 'Nom :',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Entrer le nom',
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'lastName',
                TextType::class,
                [
                    'label' => 'Prénom :',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Entrer le prénom',
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Mail :',
                    'required' => true,
                    'attr' => [
                        'placeholder' => "Entrer l'email",
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'phoneNumber',
                NumberType::class,
                [
                    'label' => 'Téléphone (FR) :',
                    'required' => true,
                    'attr' => [
                        'placeholder' => '0605040302',
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
