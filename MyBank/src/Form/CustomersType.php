<?php

namespace App\Form;

use App\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Validator\Constraints\Length;

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
            ->add('gender', ChoiceType::class, array(
                'choices'  => array(
                    'Female' => 'F',
                    'Male' => 'M'
                )))
            ->add('birth', DateType::class, array(
                // renders it as a single text box
                'widget' => 'single_text',
            ))
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
            ->add('pin', NumberType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 1, 'max'=>5)))
            ))
            ->add('mobile',TextType::class,array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>50)))
            ))
            ->add('email',EmailType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>50)))
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
