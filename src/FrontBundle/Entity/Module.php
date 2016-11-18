<?php

namespace FrontBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="module")
 */
class Module
{
    // TODO add description

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *  @ORM\Column(type="string", unique=true)
     */
    protected $name;

    /**
     *  @ORM\Column(type="string", unique=true)
     */
    protected $enterUrl;

    /**
     *  @ORM\Column(type="string")
     */
    protected $developperName;

    /**
     *  @ORM\Column(type="string", nullable=true)
     */
    protected $pathImage;

    /**
     *  @ORM\Column(type="datetime")
     */
    protected $addedAt;

    /**
     *  @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     *  @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\ConnectedObject")
     */
    protected $object;

    /**
     * @ORM\ManyToMany(targetEntity="FrontBundle\Entity\User", cascade={"persist"}, inversedBy="modules")
     */
    protected $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
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
        $this->enterUrl = "/import/module/" . $name;
    }

    /**
     * @return mixed
     */
    public function getDevelopperName()
    {
        return $this->developperName;
    }

    /**
     * @param mixed $developperName
     */
    public function setDevelopperName($developperName)
    {
        $this->developperName = $developperName;
    }

    /**
     * @return mixed
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * @param mixed $addedAt
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Set object
     *
     * @param \FrontBundle\Entity\ConnectedObject $object
     *
     * @return Module
     */
    public function setObject(\FrontBundle\Entity\ConnectedObject $object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \FrontBundle\Entity\ConnectedObject
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Add user
     *
     * @param \FrontBundle\Entity\User $user
     *
     * @return Module
     */
    public function addUser(\FrontBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \FrontBundle\Entity\User $user
     */
    public function removeUser(\FrontBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set enterUrl
     *
     * @param string $enterUrl
     *
     * @return Module
     */
    public function setEnterUrl($enterUrl)
    {
        $this->enterUrl = $enterUrl;

        return $this;
    }

    /**
     * Get enterUrl
     *
     * @return string
     */
    public function getEnterUrl()
    {
        return $this->enterUrl;
    }

    /**
     * Set pathImage
     *
     * @param string $pathImage
     *
     * @return Module
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
}
