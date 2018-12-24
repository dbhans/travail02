<?php

namespace App\Form;

use App\Entity\Transactions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Length;

class TransactionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',TextareaType::class, array(
                
                'required'=> true,
                  'constraints' =>  array(new Length( array('max'=>255))) 
                  ))
            ->add('amount',TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('max'=>12)))
            ) )
            ->add('type',ChoiceType::class, array(
                'choices'  => array(
                    'Deposit' => 'Deposit',
                    'Withdra1wal' => 'Withdra1wal'
                )))
            ->add('date', DateType::class, array(
                'required'=> true,
                // renders it as a single text box
                'widget' => 'single_text',
            ))
            ->add('iduser',NumberType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('max'=>12))),
                'label' => 'Customer'
            ) )
            ->add('account')
            ->add('transfer', Hiddentype::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transactions::class,
        ]);
    }
}
