<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.2.18
 * Time: 18:15
 */

namespace AppBundle\Forms;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LogInType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,[
                'label' => 'Uživatelské jméno nebo E-mail:',
            ])
            ->add('password', PasswordType::class,[
                'label' => 'Heslo:',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Přihlásit',
                'attr' => array(
                    'class' => 'button',
                ),
            ])
        ;
    }
}