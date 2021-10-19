<?php
declare(strict_types=1);

namespace App\Model;
use App\Model\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group 
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
     * @ORM\ManyToMany(targetEntity="App\Domain\User\User", mappedBy="groups")
     */
    private $users;

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
     * Set private information
     */
    public function setPrivate($private){
        $this->private = $private;
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
     * @param int|null $id
     * @param string   $name
     * @param string   $description
     * @param int|null $private
     */
    public function __construct(?int $id, string $name, string $description, User $admin)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->admin = $admin;
    }

}
