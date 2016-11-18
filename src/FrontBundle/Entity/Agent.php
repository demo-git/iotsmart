<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="agent")
 */
class Agent
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
     * @ORM\Column(type="string")
     */
    protected $compatibleVersion;

    /**
     * @ORM\Column(type="integer")
     */
    protected $objectId;

    /**
     * @ORM\Column(type="string")
     */
    protected $downloadLink;

    /**
     * @ORM\Column(type="integer")
     */
    protected $downloadCount;

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
    public function getCompatibleVersion()
    {
        return $this->compatibleVersion;
    }

    /**
     * @param mixed $compatibleVersion
     */
    public function setCompatibleVersion($compatibleVersion)
    {
        $this->compatibleVersion = $compatibleVersion;
    }

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * @param mixed $objectId
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }

    /**
     * @return mixed
     */
    public function getDownloadLink()
    {
        return $this->downloadLink;
    }

    /**
     * @param mixed $downloadLink
     */
    public function setDownloadLink($downloadLink)
    {
        $this->downloadLink = $downloadLink;
    }

    /**
     * @return mixed
     */
    public function getDownloadCount()
    {
        return $this->downloadCount;
    }

    /**
     * @param mixed $downloadCount
     */
    public function setDownloadCount($downloadCount)
    {
        $this->downloadCount = $downloadCount;
    }
}