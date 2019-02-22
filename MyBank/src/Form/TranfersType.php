<?php

namespace App\Form;

use App\Entity\Tranfers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Length;

class TranfersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('transfer', null, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('max'=>10))),
                'label' => 'Transfer Amount  '
          ) )
            ->add('payer', null, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('max'=>10))),
                'label' => 'Payer'
          ) )
            ->add('payee', null, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('max'=>10))),
                'label' => 'Payee'
          ) )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tranfers::class,
        ]);
    }
}
