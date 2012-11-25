<?php

namespace DCMS\Bundle\AdminBundle\DataFixtures\PHPCR;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use DCMS\Bundle\MenuBundle\Document\MenuEndpoint;

class LoadMenuEndpointData implements FixtureInterface, DependentFixtureInterface
{
    public function getDependencies()
    {
        return array(
            'DCMS\Bundle\CoreBundle\DataFixtures\PHPCR\LoadSiteData',
        );
    }

    public function load(ObjectManager $manager)
    {
        $rt = $manager->find(null, '/sites/dantleech/endpoints');

        $e = new MenuEndpoint;
        $e->setParent($rt);
        $e->setNodeName('Menu 1');
        $e->setPath('/menu-1');
        $manager->persist($e);

        $e = new MenuEndpoint;
        $e->setParent($rt);
        $e->setNodeName('Menu 3');
        $e->setPath('/menu-3');
        $manager->persist($e);

        $manager->flush();
    }
}
