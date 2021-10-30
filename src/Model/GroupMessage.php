<?php
declare(strict_types=1);

namespace App\Model;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use App\Model\Group;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="messages_des_groupes")
 */
class GroupMessage implements JsonSerializable
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
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity="App\Model\Group")
     * @ORM\JoinTable(name="messages_groups")
     */
    private $groups;

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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return PersistentCollection
     */
    public function getGroups(): PersistentCollection
    {
        return $this->groups;
    }

    /**
     * @return date
     */
    public function getSendDateString(): string
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
     * Set property
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set property
     */
    public function setContent($content)
    {
        $this->$content = $content;
    }
    
    public function addGroup(Group $group){
        $this->groups->add($group);
    }

    public function removeGroup(Group $group){
        $this->groups->removeElement($group);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'content' => $this->content,
            'groups' => $this->groups,
            'send_date' => $this->getSendDateString()
        ];
    }

    /**
     * @param int|null $id
     * @param string   $username
     * @param string   $content
     * @param date   $sendDate
     */

    public function __construct(
        ?int $id,
        string $username,
        string $content
    ) {
        $this->id = $id;
        $this->username = strtolower($username);
        $this->content = ucfirst($content);
        $this->sendDate = new DateTime();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();

    }

}
