<?php
declare(strict_types=1);
namespace App\Model;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="messages")
 */
class Message 
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
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $body;


    /**
     * @param int|null $id
     * @param string   $id_receiver
     * @param string   $id_transmitter
     * @param string   $date
     * @param string   $body
     */
    public function __construct(?int $id,  string $date, string $body) {
        $date_format = 'd/m/Y';
        $this->id = $id;
        $this->date = DateTime::createFromFormat($date_format, $date);
        $this->body = $body;
    }

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
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

}
