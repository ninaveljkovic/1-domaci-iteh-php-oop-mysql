<?php
    include '../dbbroker.php';
    include '../model/Termin.php';
 
 

    if(isset($_POST["zaposleni"]) && isset($_POST["datum"]) && isset($_POST["tretmani"]) ){
       
        
         $termin = new Termin(null,$_POST["datum"],$_POST["zaposleni"],$_POST["tretmani"]);
        
        $status= Termin::dodajTermin($termin,$conn);
         
        
          if($status){
             echo 'Success';
          }else{
              echo $status;
              echo 'Failed';
          }
    } 
  

?>