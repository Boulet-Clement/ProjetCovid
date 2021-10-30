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
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $mail;

    /**
     * @ORM\ManyToMany(targetEntity="App\Model\Group")
     * @ORM\JoinTable(name="messages_groups")
     */
    private $groups;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $contaminated;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var DateTime
     * @ORM\Column(type="date")
     */
    private $joinDate;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Model\Group", mappedBy="users")
     */

    private $admins;

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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @return PersistentCollection
     */
    public function getGroups(): PersistentCollection
    {
        return $this->groups;
    }

    /**
     * @return bool
     */
    public function getContaminated(): ?bool
    {
        return $this->contaminated;
    }

    /**
     * @return date
     */
    public function getJoinDateString(): string
    {

        return date_format($this->joinDate, 'd F Y');
    }

    /**
     * @return date
     */
    public function getJoinDate(): DateTime
    {
        return $this->joinDate;
    }

    /**
     * @return string
    */
    public function getAdmins(): array
    {
        return $this->admins;
    }

    /**
     * @return bool
    */
    public function isCurrentUser(): bool
    {
        return $_SESSION['userId'] == $this->id;
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
    public function setFirstname($firstName)
    {
        $this->$firstName = $firstName;
    }

    /**
     * Set property
     */
    public function setLastname($lastName)
    {
        $this->$lastName = $lastName;
    }
    
    /**
     * Set property
     */
    public function setMail($mail)
    {
        $this->$mail = $mail;
    }

    /**
     * Set property
     */
    public function setPassword($password)
    {
        $this->$password = $password;
    }
    
    public function addGroup(Group $group){
        $this->groups->add($group);
    }

    public function removeGroup(Group $group){
        $this->groups->removeElement($group);
    }

    public function addAdmin(Group $group){
        $this->admin->add($group);
    }

    public function isAdmin($group_id){
        foreach ($this->admin as $group => $object){
            if ($group_id == $object->getId()){
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'password' => $this->password,
            'mail' => $this->mail,
            'groups' => $this->groups,
            'contaminated' => (bool)$this->contaminated,
            'join_date' => $this->getJoinDateString()
        ];
    }




    /**
     * @param int|null $id
     * @param string   $username
     * @param string   $firstName
     * @param string   $lastName
     * @param string   $mail
     * @param string   $password
     * @param date   $joinDate
     */

    public function __construct(
        ?int $id,
        string $username,
        string $firstName,
        string $lastName,
        string $mail,
        string $password
    ) {
        $this->id = $id;
        $this->username = strtolower($username);
        $this->firstName = ucfirst($firstName);
        $this->lastName = ucfirst($lastName);
        $this->password = $password;
        $this->mail = strtolower($mail);
        $this->contaminated = false;
        $this->joinDate = new DateTime();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->admins = new \Doctrine\Common\Collections\ArrayCollection();

    }

}
