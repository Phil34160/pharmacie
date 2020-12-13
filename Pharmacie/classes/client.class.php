<?php
    class Client{
        protected $name;
        protected $credit;

        public function __construct($n,$c)
        {
            $this->name = $n;
            $this->credit = $c;
        }
        public function getAffichage(){
            return "Nom : ".$this->name."<br> crédit : ".$this->credit; 
        }
        public function achat(){
            
        }
    }
?>