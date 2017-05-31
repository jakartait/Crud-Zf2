<?php

namespace Application\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Writer
 *
 * @ORM\Table(name="public.writer")
 * @ORM\Entity
 */
class Writers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="writer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="writer_id_seq", allocationSize=1, initialValue=1)
     */
    private $writerId;

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
	 * @return the $writerId
	 */
	public function getWriterId()
	{
		return $this->writerId;
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
	 * @param number $writerId
	 */
	public function setWriterId($writerId)
	{
		$this->writerId = $writerId;
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
		$this->writerId= (isset($data['writer_id'])) ? $data['writer_id']:null;
		$this->name= (isset($data['name'])) ? $data['name'] :null;
	}

}

