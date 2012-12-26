<?php

namespace DCMS\Bundle\CoreBundle\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use DCMS\Bundle\CoreBundle\Validation\Constraints as RoutingValidation;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\Route;

/**
 * @PHPCR\Document(nodeType="dcms:endpoint",referenceable=true, repositoryClass="DCMS\Bundle\CoreBundle\Repository\EndpointRepository")
 */
class Endpoint
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
     * @PHPCR\Children()
     */
    protected $children;

    /** 
     * @PHPCR\NodeName
     */
    protected $nodeName;

    /**
     * @PHPCR\Node
     */
    protected $node;

    /**
     * @PHPCR\String()
     */
    protected $path;

    /**
     * @PHPCR\referenceOne(strategy="hard", targetDocument="DCMS\Bundle\ThemeBundle\Document\Template")
     */
    protected $layout;

    /**
     * @PHPCR\String()
     */
    protected $epClass;

    /**
     * @PHPCR\String(multivalue=true)
     */
    protected $parameters;

    /**
     * @PHPCR\Boolean()
     */
    protected $showInMenu = true;

    /**
     * @PHPCR\Boolean()
     */
    protected $inheritPath = false;

    /**
     * @PHPCR\Boolean()
     */
    protected $routeable = true;

    public function getId()
    {
        return $this->id;
    }

    public function getParent()
    {
        return $this->parent;
    }
    
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getChildren()
    {
        $children = array();
        foreach ($this->children as $child) {
            if ($child instanceOf Endpoint) {
                $children[] = $child;
            }
        }
        return $children;
    }
    
    public function setChildren($children)
    {
        $this->children = $children;
    }

    public function addChild($child)
    {
        if (null === $this->children) {
            $this->children = new ArrayCollection();
        }
        $this->children->add($child);
    }

    public function getNodeName()
    {
        return $this->nodeName;
    }
    
    public function setNodeName($nodeName)
    {
        $this->nodeName = $nodeName;
    }

    public function getPath()
    {
        return $this->path;
    }
    
    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getEpClass()
    {
        return $this->epClass;
    }
    
    public function setEpClass($epClass)
    {
        $this->epClass = $epClass;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
    
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function getUuid()
    {
        return $this->uuid;
    }
    
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    public function getLayout()
    {
        return $this->layout;
    }
    
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function __toString()
    {
        return $this->nodeName;
    }

    public function getNode()
    {
        return $this->node;
    }

    public function getShowInMenu()
    {
        return $this->showInMenu;
    }
    
    public function setShowInMenu($showInMenu)
    {
        $this->showInMenu = $showInMenu;
    }

    public function getInheritPath()
    {
        return $this->inheritPath;
    }
    
    public function setInheritPath($inheritPath)
    {
        $this->inheritPath = $inheritPath;
    }

    public function getRouteable()
    {
        return $this->routeable;
    }
    
    public function setRouteable($routeable)
    {
        $this->routeable = $routeable;
    }

    public function getFullPath()
    {
        $parents = array();
        $currentParent = $this;
        $paths = array(
            $this->getPath(),
        );
        while ($parent = $currentParent->getParent()) {
            if (false === $parent instanceOf Endpoint) {
                break;
            }

            if (false === $parent->getRouteable()) {
                break;
            }
            $path = $parent->getPath();
            $paths[] = $path;
            $currentParent = $parent;
        }

        $fullPath = implode('/', array_reverse($paths));
        $fullPath = str_replace('//', '/', $fullPath);
        return $fullPath;
    }
}
