<?php

namespace App\Form;

use App\Entity\Transactions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TransactionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',TexType::class, array(
                'constraints' =>  array(new Length( array('max'=>12)))
            ) )
            ->add('amount',TexType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>12)))
            ) )
            ->add('type',TexType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>12)))
            ) )
            ->add('date',TexType::class, array(
                'required'=> true            ) )
            ->add('iduser')
            ->add('account')
            ->add('transfer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transactions::class,
        ]);
    }
}
