<?php
declare(strict_types=1);
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
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
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;


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
     * Setter
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setFirstname($firstName)
    {
        $this->$firstName = $firstName;
    }

    public function setLastname($lastName)
    {
        $this->$lastName = $lastName;
    }
    
    public function setMail($mail)
    {
        $this->$mail = $mail;
    }

    public function setPassword($password)
    {
        $this->$password = $password;
    }
    
    /**
     * Constructeur
     * @param int|null $id
     * @param string   $username
     * @param string   $firstName
     * @param string   $lastName
     * @param string   $mail
     * @param string   $password
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
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->mail = $mail;
    }

}
