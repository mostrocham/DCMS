<?php

namespace DCMS\Bundle\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('date', 'datetime', array(
            'widget' => 'single_text',
        ));
        $builder->add('status', 'choice', array(
            'choices' => array(
                'draft' => 'Draft',
                'published' => 'Published',
            ),
        ));
        $builder->add('body', 'dcms_markdown_textarea', array(
            'preview' => false,
        ));
        $builder->add('blog', 'phpcr_document', array(
            'class' => 'DCMS\Bundle\BlogBundle\Document\BlogEndpoint',
        ));
        $builder->add('csvTags');
    }

    public function getName()
    {
        return 'post';
    }

    public function getDefaultOptions(array $options)
    {
        $options = parent::getDefaultOptions($options);
        $options['data_class'] = 'DCMS\Bundle\BlogBundle\Document\Post';
        return $options;
    }
}