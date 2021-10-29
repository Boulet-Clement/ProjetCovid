<?php
declare(strict_types=1);

namespace App\Model;
use App\Model\Group;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_Messages")
 */
class GroupMessage
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $sender;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="App\Model\Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    private $group;

    /**
     * @var DateTime
     * @ORM\Column(type="date")
     */
    private $sendDate;    

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }


    /**
     * @return date
     */
    public function getJoinDateString(): string
    {

        return date_format($this->sendDate, 'd F Y');
    }

    /**
     * @return date
     */
    public function getSendDate(): DateTime
    {
        return $this->sendDate;
    }

    /**
     * @param int|null $id
     * @param string   $sender
     * @param string   $content
     * @param date   $sendDate
     * @param Group $group
     */

    public function __construct(
        ?int $id,
        string $sender,
        string $content,
        Group $group
    ) {
        $this->id = $id;
        $this->sender = $sender;
        $this->content =  $content;
        $this->sendDate = new DateTime();
        $this->group = $group;
    }

}
