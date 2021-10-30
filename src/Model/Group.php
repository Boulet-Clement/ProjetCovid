<?php
declare(strict_types=1);

namespace App\Model;

use App\Model\User;
use App\Model\GroupMessage;
use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group implements JsonSerializable
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
     * @ORM\ManyToMany(targetEntity="App\Model\User", mappedBy="groups")
     */
    private $users;

    /**
     * @var string
     * @ORM\ManyToMany(targetEntity="App\Model\GroupMessage", mappedBy="groups")
     */
    private $groupMessages;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="App\Model\User")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id")
     */
    private $admin;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

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
    public function getname(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    public function addUser(User $user){
        $this->users->add($user);
    }

    public function getUsers(){
        return $this->users;
    }

    public function addGroupMessage(GroupMessage $groupMessage){
        $this->groupMessages->add($groupMessage);
    }

    public function getGroupMessages(){
        return $this->groupMessages;
    }

    public function getGroupAdmin()
    {
        return $this->admin;
    }

    public function hasUser($id): bool
    {
        for ($i = 0; $i < count($this->users); $i += 1){
            if ($this->users[$i]->getId() == $id){
                return true;
            }
        }
        return false;

    }

    public function hasMessages($id): bool
    {
        for ($i = 0; $i < count($this->groupMessages); $i += 1){
            if ($this->groupMessages[$i]->getId() == $id){
                return true;
            }
        }
        return false;

    }

    /**
     * @return bool
     */
    public function checkAdmin($id):bool
    {
        if($id == $this->admin->getId()){
            return true;
        }
        return false;
    }
    
    /**
     * Set user as admin
     */
    public function setAdmin(User $user){
        $this->admin = $user;
    }

    /**
     * Set groupname
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * Set description
     */
    public function setDescription($description){
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'users' => $this->users
        ];
    }



    /**
     * @param int|null $id
     * @param string   $name
     * @param string   $description
     */
    public function __construct(?int $id, string $name, string $description, User $admin)
    {
        $this->id = $id;
        $this->name = strtolower($name);
        $this->description = ucfirst($description);
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groupMessages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->admin = $admin;
    }

}
