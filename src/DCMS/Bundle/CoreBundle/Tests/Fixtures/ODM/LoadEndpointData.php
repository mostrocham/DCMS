<?php

namespace DCMS\Bundle\CoreBundle\Tests\Fixtures\ODM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use DCMS\Bundle\CoreBundle\Document\Site;
use DCMS\Bundle\CoreBundle\Document\Endpoint;

class LoadEndpointData implements FixtureInterface, DependentFixtureInterface
{
    public function getDependencies()
    {
        return array(
            'DCMS\Bundle\CoreBundle\Tests\Fixtures\ODM\LoadSiteData'
        );
    }

    public function load(ObjectManager $manager)
    {
        $rt = $manager->find(null, '/sites/dantleech/endpoints');

        $home = new Endpoint;
        $home->setParent($rt);
        $home->setName('home');
        $manager->persist($home);

        $contact = new Endpoint;
        $contact->setParent($home);
        $contact->setNodeName('contact');
        $manager->persist($contact);

        $manager->flush();
    }
}


