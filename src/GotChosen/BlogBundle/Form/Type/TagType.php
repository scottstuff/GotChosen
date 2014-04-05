<?php
// GotChosen/BlogBundle/Form/Type/TagType.php
namespace GotChosen\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GotChosen\BlogBundle\Entity\Tag',
        ));
    }

    public function getName()
    {
        return 'tag';
    }
}