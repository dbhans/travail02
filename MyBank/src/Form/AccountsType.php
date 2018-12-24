<?php

namespace App\Form;

use App\Entity\Accounts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Length;

class AccountsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('account', TextType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>12)))
                ))
            ->add('description', TextareaType::class, array(
                'attr' => array('class' => 'description'),
                  'constraints' =>  array(new Length( array('max'=>255))) 
                  ))
            ->add('type',ChoiceType::class, array(
                'choices'  => array(
                    'Saving' => 'Saving',
                    'Cheque' => 'Cheque'
                )))
            ->add('customer', null, array(
                'constraints' =>  array(new Length( array('max'=>10))),
                'label' => 'Customer Id'
          ) )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accounts::class,
        ]);
    }
}
