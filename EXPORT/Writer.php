<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Writer
 *
 * @ORM\Table(name="writer")
 * @ORM\Entity
 */
class Writer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="writer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="writer_writer_id_seq", allocationSize=1, initialValue=1)
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


}

