<?php

namespace ApiBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class DataObject
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $datas;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $tokenData;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $createAt;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datas
     *
     * @param string $datas
     * @return $this
     */
    public function setDatas($datas)
    {
        $this->datas = $datas;
        return $this;
    }

    /**
     * Get datas
     *
     * @return string $datas
     */
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * Set tokenData
     *
     * @param string $tokenData
     * @return $this
     */
    public function setTokenData($tokenData)
    {
        $this->tokenData = $tokenData;
        return $this;
    }

    /**
     * Get tokenData
     *
     * @return string $tokenData
     */
    public function getTokenData()
    {
        return $this->tokenData;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return $this
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;
        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime $createAt
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }
}
