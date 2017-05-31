<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 *
 * @ORM\Table(name="books")
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
     * @ORM\SequenceGenerator(sequenceName="books_book_id_seq", allocationSize=1, initialValue=1)
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
     * @var integer
     *
     * @ORM\Column(name="publisher_id", type="integer", nullable=true)
     */
    private $publisherId;

    /**
     * @var integer
     *
     * @ORM\Column(name="writer_id", type="integer", nullable=true)
     */
    private $writerId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="date", nullable=true)
     */
    private $updateDate;


}

