<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="connected_object")
 */
class ConnectedObject
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="string")
     */
    protected $brand;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     *  @ORM\Column(type="string", nullable=true)
     */
    protected $pathImage;

    /**
     * @ORM\OneToOne(targetEntity="FrontBundle\Entity\Agent", cascade={"persist"})
     */
    protected $agent;

    /**
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\TypeConnectedObject")
     */
    protected $typeObject;

    /**
     * @ORM\OneToMany(targetEntity="UserConnectedObject", mappedBy="connectedObject")
     */
    protected $userConnectedObjects;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @param mixed $agent
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
    }

    /**
     * @return mixed
     */
    public function getTypeObject()
    {
        return $this->typeObject;
    }

    /**
     * @param mixed $typeObject
     */
    public function setTypeObject($typeObject)
    {
        $this->typeObject = $typeObject;
    }

    /**
     * @return mixed
     */
    public function getUserObjects()
    {
        return $this->userConnectedObjects;
    }

    /**
     * @param mixed $userConnectedObjects
     */
    public function setUserObjects($userConnectedObjects)
    {
        $this->userConnectedObjects = $userConnectedObjects;
    }

    /**
     * @return mixed
     */
    public function getPathImage()
    {
        return $this->pathImage;
    }

    /**
     * @param mixed $pathImage
     */
    public function setPathImage($pathImage)
    {
        $this->pathImage = $pathImage;
    }

    /**
     * @return mixed
     */
    public function getUserConnectedObjects()
    {
        return $this->userConnectedObjects;
    }

    /**
     * @param mixed $userConnectedObjects
     */
    public function setUserConnectedObjects($userConnectedObjects)
    {
        $this->userConnectedObjects = $userConnectedObjects;
    }
}
