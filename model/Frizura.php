<?php

    class Frizura{
        private $id;
        private $naziv;
        private $vreme; 
        private $cena; 



        public function __construct($id=null, $naziv=null,$vreme =null, $cena=null ){
            $this->id=$id;
            $this->naziv=$naziv; 
            $this->cena=$cena;  
            $this->vreme=$vreme; 

        }
 

        public static function vratiSveFrizure($conn){
            $upit ="select * from frizura";

            return $conn->query($upit);
        }




      





    }




?>