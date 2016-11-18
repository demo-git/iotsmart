<?php
/**
 * Created by PhpStorm.
 * User: Gess
 * Date: 15/11/2016
 * Time: 10:47
 */
namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_connected_object")
 */
class UserConnectedObject
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userConnectedObjects")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="ConnectedObject", inversedBy="userConnectedObjects")
     * @ORM\JoinColumn(name="connected_object_id", referencedColumnName="id", nullable=false)
     */
    protected $connectedObject;

    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    protected $tokenData;

    /**
     * @ORM\Column(type="string")
     */
    protected $connectionString;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getConnectedObject()
    {
        return $this->connectedObject;
    }

    /**
     * @param mixed $connectedObject
     */
    public function setConnectedObject($connectedObject)
    {
        $this->connectedObject = $connectedObject;
    }

    /**
     * @return mixed
     */
    public function getTokenData()
    {
        return $this->tokenData;
    }

    /**
     * @param mixed $tokenData
     */
    public function setTokenData($tokenData)
    {
        $this->tokenData = $tokenData;
    }

    /**
     * @return mixed
     */
    public function getConnectionString()
    {
        return $this->connectionString;
    }

    /**
     * @param mixed $connectionString
     */
    public function setConnectionString($connectionString)
    {
        $this->connectionString = $connectionString;
    }
}