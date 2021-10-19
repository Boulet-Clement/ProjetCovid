<?php
declare(strict_types=1);
namespace App\Messagerie;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="messages")
 */
class Messagerie
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
     * @var int
     * @ORM\OneToMany(targetEntity="App\User", mappedBy="listusers")
     */
    private $list_Users;

    /**
     * @var int
     * @ORM\OneToMany(targetEntity="App\Message", mappedBy="listmessage")
     */
    private $list_Messages;





    /**
     * @param int|null $id
     * @param string   $list_Messages
     * @param string   $list_Users

     */
    public function __construct(?int $id) {
        $this->list_Users = new ArrayCollection();
        $this->list_Messages = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getMessages(): ?int
    {
        return $this->list_Messages;
    }

    /**
     * @return string
     */
    public function getUsers(): string
    {
        return $this->listUsers;
    }

    public function addUsers($User){
        $this->listUsers.push($User);
    }

    public function addMessages($Message){
        $this->listMessages.push($Message);
    }
}
