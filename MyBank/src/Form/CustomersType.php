<?php

namespace App\Form;

use App\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CustomersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array( 'max'=>25)))
            ) )
            ->add('lastname',TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('max'=>25)))
            ) )
            ->add('gender')
            ->add('birth')
            ->add('address',TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>25)))
            ) )
            ->add('city',TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>25)))
            ) )
            ->add('state',TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>25)))
            ) )
            ->add('pin',TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>25)))
            ))
            ->add('mobile')
            ->add('email',TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>25)))
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customers::class,
        ]);
    }
}
