<?php

    require "../dbbroker.php";
    require "../model/Termin.php";
     
    if(isset($_POST['id'])){
         
        $myArray = Termin::prikaziTerminpoID($_POST['id'],$conn);
        
        echo json_encode($myArray);
    }








    

?>