<?php

namespace DCMS\Bundle\CoreBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use DCMS\Bundle\CoreBundle\Site\DocumentOrganizer;
use Doctrine\Common\Util\ClassUtils;
use DCMS\Bundle\CoreBundle\Module\ModuleManager;

class DCMSSiteAdmin extends DCMSAdmin
{
    public function __construct($code, $class, $baseControllerName = null)
    {
        $baseControllerName = 'DCMSCoreBundle:CRUD';
        parent::__construct($code, $class, $baseControllerName);
    }

    public function getTemplate($name)
    {
        if ($name == 'layout') {
            return 'DCMSCoreBundle:Admin:layout.html.twig';
        }

        return parent::getTemplate($name);
    }
}
