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
   
        
        public static function obrisiTermin($id, $conn){
            $upit = "delete from termin where id_ter=$id";

            return $conn->query($upit); 

        }

        
        public static function dodajTermin($termin, $conn){
            $upit = "insert into termin(datum,zaposleni,frizura) values('$termin->datumVreme','$termin->zaposleni','$termin->frizura')";
            
            return $conn->query($upit); 
        }


        public static function prikaziTerminpoID($id, $conn){
            $upit = "select * from termin t inner join zaposleni z on z.id=t.zaposleni inner join frizura f on f.id_friz = t.frizura where t.id_ter=$id";
            $myArray = array();
            $result = $conn->query($upit);
            
            if($result){
                while($row = $result->fetch_array()){
    
                    $myArray[] = $row;
                }
            }
            
            return  $myArray ;

        }


        public static function promeniTermin($termin,$conn){
            $upit = "update termin set datum='$termin->datumVreme', frizura=$termin->frizura, zaposleni=$termin->zaposleni where id_ter=$termin->id";
               
            return $conn->query($upit); 
        }


    }



?>