<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label'=>'Název'))
            ->add('client', null, array('label'=>'Kient'))
            ->add('isBilled', null, array('label'=>'Placený'))
            ->add('isGrouped', null, array('label'=>'Faktura: Seskupit položky do jedné'))
            ->add('groupName', null, array('label'=>'Faktura: Text seskupení na faktuře'))
            ->add('rate', null, array('label'=>'Faktura: Sazba'))
            ->add('minHours', null, array('label'=>'Faktura: Min. hodin'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project'
        ));
    }
}
