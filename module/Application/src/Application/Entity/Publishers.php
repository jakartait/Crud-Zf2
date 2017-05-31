<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publisher
 *
 * @ORM\Table(name="public.publisher")
 * @ORM\Entity
 */
class Publishers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="publisher_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="publisher_id_seq", allocationSize=1, initialValue=1)
     */
    private $publisherId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="date", nullable=true)
     */
    private $updateDate;
	/**
	 * @return the $publisherId
	 */
	public function getPublisherId()
	{
		return $this->publisherId;
	}

	/**
	 * @return the $name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return the $updateDate
	 */
	public function getUpdateDate()
	{
		return $this->updateDate;
	}

	/**
	 * @param number $publisherId
	 */
	public function setPublisherId($publisherId)
	{
		$this->publisherId = $publisherId;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @param DateTime $updateDate
	 */
	public function setUpdateDate($updateDate)
	{
		$this->updateDate = $updateDate;
	}

	
	public function exchangeArray($data)
	{
		$this->publisherId = (isset($data['publisher_id'])) ? $data['publisher_id']:null;
		$this->name= (isset($data['name'])) ? $data['name'] :null;
	}

    

}

