<?php
declare(strict_types=1);

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="App\Model\User")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id")
     */
    private $admin;


    /**
     * @var string
     * @ORM\ManyToMany(targetEntity="App\Model\User", mappedBy="groups")
     */
    private $users;



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
    public function getName(): string
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

    /**
     * @return string
     */
    public function getadmin(): string
    {
        return $this->admin;
    }
    
    /**
     * @return 
     */
    public function getUsers(){
        return $this->users;
    }


    /**
     * Setter
     */

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }
    
    /**
     * Constructeur
     * @param int|null $id
     * @param string   $name
     * @param string   $description
     * @param string   $admin
     */

    public function __construct(
        ?int $id,
        string $name,
        string $description,
        string $admin
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->admin = $admin;
        $this->users = new ArrayCollection();
    }

}
