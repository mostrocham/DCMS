<?php

namespace DCMS\Bundle\CoreBundle\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * @PHPCR\Document
 */
class Site
{
    /** 
     * @PHPCR\Id
     */
    protected $id;

    /**
     * @PHPCR\Uuid
     */
    protected $uuid;

    /** 
     * @PHPCR\ParentDocument
     */
    protected $parent;

    /**
     * @PHPCR\Children(filter="*")
     */
    protected $children;

    /** 
     * @PHPCR\NodeName
     */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getUuid()
    {
        return $this->uuid;
    }
    
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    public function getParent()
    {
        return $this->parent;
    }
    
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getChildren()
    {
        return $this->children;
    }
    
    public function setChildren($children)
    {
        $this->children = $children;
    }
}
