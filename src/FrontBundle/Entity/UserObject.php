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
 * @ORM\Table(name="user_object")
 */
class UserObject
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="User", inversedBy="objects")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="ConnectedObject", inversedBy="users")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", nullable=false)
     */
    protected $object;

    /**
     * @ORM\Column(type="string")
     */
    protected $tokenData;

    /**
     * @ORM\Column(type="string")
     */
    protected $connectionString;
}