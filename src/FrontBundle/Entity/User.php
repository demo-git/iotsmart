<?php

namespace FrontBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="UserConnectedObject", mappedBy="user")
     * @var ArrayCollection $userConnectedObjects
     */
    protected $userConnectedObjects;
    
    /**
     *  @ORM\Column(type="string")
     */
    protected $firstName;

    /**
     *  @ORM\Column(type="string")
     */
    protected $lastName;

    /**
     *  @ORM\Column(type="string", nullable=true)
     */
    protected $pathImage;

    /**
     * @ORM\ManyToMany(targetEntity="FrontBundle\Entity\Module", cascade={"persist"}, mappedBy="users")
     */
    protected $modules;


    public function __construct()
    {
        parent::__construct();
        $this->modules = new ArrayCollection();
    }

    /**
     * Add module
     *
     * @param \FrontBundle\Entity\Module $module
     *
     * @return User
     */
    public function addModule(\FrontBundle\Entity\Module $module)
    {
        $this->modules->add($module);

        return $this->modules;
    }

    /**
     * Remove module
     *
     * @param \FrontBundle\Entity\Module $module
     */
    public function removeModule(\FrontBundle\Entity\Module $module)
    {
        $this->modules->removeElement($module);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules()
    {
        return $this->modules;
    }

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

    /**
     * Set pathImage
     *
     * @param string $pathImage
     *
     * @return User
     */
    public function setPathImage($pathImage)
    {
        $this->pathImage = $pathImage;

        return $this;
    }

    /**
     * Get pathImage
     *
     * @return string
     */
    public function getPathImage()
    {
        return $this->pathImage;
    }

    /**
     * Add object
     *
     * @param \FrontBundle\Entity\UserConnectedObject $userConnectedObjects
     *
     * @return User
     */
    public function addUserConenctedObject(\FrontBundle\Entity\UserConnectedObject $userConnectedObjects)
    {
        $this->userConnectedObjects[] = $userConnectedObjects;

        return $this;
    }

    /**
     * Remove object
     *
     * @param \FrontBundle\Entity\UserConnectedObject $userConnectedObjects
     */
    public function removeUSerConnectedObject(\FrontBundle\Entity\UserConnectedObject $userConnectedObjects)
    {
        $this->userConnectedObjects->removeElement($userConnectedObjects);
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setFirstName($name)
    {
        $this->firstName = $name;

        return $this;
    }

    public function setLastName($name)
    {
        $this->lastName = $name;

        return $this;
    }
}
