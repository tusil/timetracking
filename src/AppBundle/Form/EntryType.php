<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', null, array('label'=>'Uživatel'))
            ->add('issuedAt', null, array('label'=>'Datum'))
            ->add('hours', null, array('label'=>'Hodiny'))
            ->add('description', TextType::class, array('label'=>'Popis'))
//            ->add('isPaid')
            ->add('save', SubmitType::class, array('label'=>'Uložit', 'attr'=>array('class'=>'btn btn-success')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Entry'
        ));
    }
}
