<?php


    class Zaposleni{

        private $id;
        private $ime;
        private $prezime;
        private $email;
        private $lozinka;


        public function __construct($id=null,$ime=null,$prezime=null,$email=null,$lozinka=null)
        {
            $this->id=$id;
            $this->ime=$ime;
            $this->prezime=$prezime;
            $this->email=$email;
            $this->lozinka=$lozinka;
 
        }
        public static function vratiSveZaposlene($conn){
            $upit ="select * from zaposleni";

            return $conn->query($upit);
        }

      





    }





?>