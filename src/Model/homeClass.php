<?php 
namespace App\Model;
class HomeClass 
{
    private $tab = [
        'test' => 'ah'
    ];
    public function getTab(){
        return $this->tab;
    }
    public function setInSession(){
        $_SESSION['Vue'] = $this;
    }
    /* Peut être créer un constructeur par parametre exemple : args  */
    public function __construct(){
        /* Mettre les variables a jour comme on les veut*/
        $this->setInSession();
    }
}
?>