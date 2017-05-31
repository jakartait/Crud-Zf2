<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 *
 * @ORM\Table(name="public.books")
 * @ORM\Entity
 */
class Books
{
    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="book_id_seq", allocationSize=1, initialValue=1)
     */
    private $bookId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_publish", type="date", nullable=true)
     */
    private $dateOfPublish;

    /**
     * @ORM\ManyToOne(targetEntity="Publishers")
     * @ORM\JoinColumn(name="publisher_id", referencedColumnName="publisher_id")
     */
    private $publisher;

    /**
     * @ORM\ManyToOne(targetEntity="Writers")
     * @ORM\JoinColumn(name="writer_id", referencedColumnName="writer_id")
     */
    private $writer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="date", nullable=true)
     */
    private $updateDate;
    /**
	 * @return the $bookId
	 */
	public function getBookId()
	{
		return $this->bookId;
	}

    /**
	 * @return the $title
	 */
	public function getTitle()
	{
		return $this->title;
	}

    /**
	 * @return the $dateOfPublish
	 */
	public function getDateOfPublish()
	{
		return $this->dateOfPublish;
	}

    /**
	 * @return the $publisherId
	 */
	public function getPublisher()
	{
		return $this->publisher;
	}

    /**
	 * @return the $writerId
	 */
	public function getWriter()
	{
		return $this->writer;
	}

    /**
	 * @return the $updateDate
	 */
	public function getUpdateDate()
	{
		return $this->updateDate;
	}

    /**
	 * @param number $bookId
	 */
	public function setBookId($bookId)
	{
		$this->bookId = $bookId;
	}

    /**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

    /**
	 * @param DateTime $dateOfPublish
	 */
	public function setDateOfPublish($dateOfPublish)
	{
		$this->dateOfPublish = $dateOfPublish;
	}

    /**
	 * @param number $publisherId
	 */
	public function setPublisher($publisher)
	{
		$this->publisher= $publisher;
		return $this;
	}

    /**
	 * @param number $writerId
	 */
	public function setWriter($writer)
	{
		$this->writer= $writer;
		return $this;
	}

    /**
	 * @param DateTime $updateDate
	 */
	public function setUpdateDate($updateDate)
	{
		$this->updateDate = $updateDate;
	}
	
	 
	public function exchangeArray(array $data){
		$this->bookId = (isset($data['book_id'])) ? $data['book_id']:null;
		$this->title = (isset($data['title'])) ? $data['title']:null;
		$this->dateOfPublish = (isset($data['date_of_publish'])) ? $data['date_of_publish']:null;
		$this->publisher = (isset($data['publisher'])) ? $data['publisher']:null;
		$this->writer= (isset($data['writer'])) ? $data['writer']:null;
		$this->updateDate= (isset($data['update_date'])) ? $data['update_date']:null;
	}
	

}

