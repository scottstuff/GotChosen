<?php

// src/GotChosen/BlogBundle/Form/Type/PostingType.php
namespace GotChosen\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PostingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('postTitle', 'text', array (
                    'label' => 'Title',
                    'label_attr' => array ('class' => 'col-xs-2'),
                    'attr' => array ('class' => 'form-control'))
                     )
                ->add('postBody', 'text', array (
                    'label' => 'Blog',
                    'label_attr' => array ('class' => 'col-xs-2'),
                    'attr' => array ('class' => 'form-control'))
                     )
                ->add('save', 'submit', array ('attr' => array ('class' => 'btn btn-lg btn-success')))
                ;
    }

    public function getName()
    {
        return 'posting';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GotChosen\BlogBundle\Entity\Posting',
        ));
    }
}
