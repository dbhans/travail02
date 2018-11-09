<?php

namespace App\Form;

use App\Entity\Useraccess;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UseraccessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TexType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array( 'max'=>12)))
            ) )
            ->add('password',TexType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>15)))
            ) )
            ->add('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Useraccess::class,
        ]);
    }
}
