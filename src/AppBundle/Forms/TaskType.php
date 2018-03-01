<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.2.18
 * Time: 18:38
 */

namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;

/**
 * Class TaskType
 */
class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task', TextType::class,[
                'label' => 'Název úkolu'
            ])
            ->add('dueDate', DateTimeType::class, [
                'label' => 'Deadline',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Popis',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Potvrdit',
                'attr' => array(
                    'class' => 'button',
                ),
            ])
        ;
    }
}
