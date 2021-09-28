<?php 
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
    public function __construct(){
        $this->setInSession();
    }
}
?>