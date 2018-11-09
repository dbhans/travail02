<?php

namespace App\Form;

use App\Entity\Accounts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Length;

class AccountsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('account', TexType::class, array(
                'required'=> true,
                'constraints' =>  array(new Length( array('min'=> 5, 'max'=>12)))))
            ->add('description', TexType::class, array(
                  'constraints' =>  array(new Length( array('max'=>255))) ))
            ->add('type')
            ->add('customer', TexType::class, array(
                'constraints' =>  array(new Length( array('max'=>2))
          ) ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accounts::class,
        ]);
    }
}
