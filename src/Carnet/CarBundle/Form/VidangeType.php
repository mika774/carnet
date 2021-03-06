<?php

namespace Carnet\CarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VidangeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd/MM/yyyy'
            ))
            ->add('nbKm', IntegerType::class)
            ->add('reparations', EntityType::class, array(
                'class' => 'CarnetCarBundle:Reparation',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true
            ))
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Carnet\CarBundle\Entity\Vidange'
        ));
    }
}
