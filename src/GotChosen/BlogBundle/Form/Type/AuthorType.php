<?php

// src/GotChosen/BlogBundle/Form/Type/AuthorType.php
namespace GotChosen\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('firstName', 'text', array (
                    'label' => 'First Name',
                    'label_attr' => array ('class' => 'col-xs-2'),
                    'attr' => array ('class' => 'form-control'))
                     )
                ->add('lastName', 'text', array (
                    'label' => 'Last Name',
                    'label_attr' => array ('class' => 'col-xs-2'),
                    'attr' => array ('class' => 'form-control'))
                     )
                ->add('userType', 'choice', array (
                    'label' => 'User Type',
                    'label_attr' => array ('class' => 'col-xs-2'),
                    'attr' => array ('class' => 'form-control'),
                    'choices' => array (
                        'blog' => 'Blogger',
                        'admin' => 'Administrator',
                        'user' => 'Basic User',
                    )
                    )
                    )
                ->add('userName', 'text', array (
                    'label' => 'User Name',
                    'label_attr' => array ('class' => 'col-xs-2'),
                    'attr' => array ('class' => 'form-control'))
                     )
                ->add('password', 'text', array (
                    'label_attr' => array ('class' => 'col-xs-2'),
                    'attr' => array ('class' => 'form-control'))
                     )
                ->add('save', 'submit', array ('attr' => array ('class' => 'btn btn-lg btn-success')))
                ;
    }

    public function getName()
    {
        return 'author';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GotChosen\BlogBundle\Entity\Author',
        ));
    }
}