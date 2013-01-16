<?php

namespace DCMS\Bundle\CoreBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use DCMS\Bundle\CoreBundle\Model\CreateEndpoint;

class EndpointAdmin extends DCMSAdmin
{
    public function getNewInstance()
    {
        return new CreateEndpoint;
    }

    protected function configureFormFields(FormMapper $fm)
    {
        $fm->add('title', 'text');
        $fm->add('type', 'dcms_endpoint_definition_choice');
    }

    protected function configureDatagridFilters(DatagridMapper $dm)
    {
        $dm->add('title', 'doctrine_phpcr_string');
    }

    protected function configureListFields(ListMapper $dm)
    {
        $dm->addIdentifier('id');
        $dm->add('title');
        $dm->add('type');
        $dm->add('status');
        $dm->add('template');
        $dm->add('updatedAt');
    }

    public function validate(ErrorElement $ee, $obj)
    {
        $ee->with('title')->assertNotBlank()->end();
    }
}