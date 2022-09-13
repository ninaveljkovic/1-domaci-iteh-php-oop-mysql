<?php


    class Termin{
        private $id;
        private $datumVreme;
        private $zaposleni;
        private $frizura;


        public function __construct($id=null,$datumVreme=null,$zaposleni=null,$frizura=null ){
            $this->id=$id;
            $this->datumVreme=$datumVreme;  
            $this->zaposleni=$zaposleni;            
            $this->frizura=$frizura;            
        }

        public static function vratiSveTermine($conn){
            $upit = "select * from termin t inner join zaposleni z on z.id=t.zaposleni inner join frizura f on f.id_friz = t.frizura";

            return $conn->query($upit); 
        }
   
        









    }



?>