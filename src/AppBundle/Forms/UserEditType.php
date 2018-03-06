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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('location', TextType::class,[
                'label' => 'Město:'
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Popis:'
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Změnit',
                'attr' => [
                    'class' => 'button',
                ]
            ]);
    }
}