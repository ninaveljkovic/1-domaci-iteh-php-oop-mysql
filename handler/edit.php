
<?php
    include '../dbbroker.php';
    include '../model/Termin.php';
    
    if(isset($_POST["zaposleniE"]) && isset($_POST["tretmaniE"]) && isset($_POST["datumE"]) && isset($_POST['skrivenoPoljeID']) ){
         $termin = new Termin($_POST['skrivenoPoljeID'],$_POST['datumE'],$_POST['zaposleniE'],$_POST["tretmaniE"]);
         $status= Termin::promeniTermin($termin,$conn);
        
       
        
          if($status){
          
             echo 'Success';
          }else{
              echo $status;
              echo 'Failed';
          }
    }



    
?>