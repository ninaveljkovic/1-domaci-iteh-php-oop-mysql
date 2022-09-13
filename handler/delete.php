<?php
    include '../dbbroker.php';
    include '../model/Termin.php';

if(isset($_POST['id'])){
    $status=Termin::obrisiTermin($_POST['id'],$conn);
    if ($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}

?>