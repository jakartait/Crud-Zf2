<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Publisher
 *
 * @ORM\Table(name="publisher")
 * @ORM\Entity
 */
class Publisher
{
    /**
     * @var integer
     *
     * @ORM\Column(name="publisher_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="publisher_publisher_id_seq", allocationSize=1, initialValue=1)
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


}

