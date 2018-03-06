<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.2.18
 * Time: 18:16
 */

namespace AppBundle\Forms;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class,[
                'first_options'  => array('label' => 'Heslo'),
                'second_options' => array('label' => 'Heslo znovu'),
                'invalid_message' => 'Hesla se v obou polích musí shodovat',
                'type' => PasswordType::class,
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Změnit',
                'attr' => [
                    'class' => 'button',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => User::class,
        ]);
    }
}