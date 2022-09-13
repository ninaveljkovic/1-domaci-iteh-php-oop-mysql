<?php
    include 'dbbroker.php';
    include 'model/Termin.php'; 
  

    $termini = Termin::vratiSveTermine($conn);
 

   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
   
    <div class="tabelaTermina">
    <button type="button" class="btn btn-primary">Dodaj novi termin</button>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">DATUM</th>
      <th scope="col">FRIZURA</th>
      <th scope="col">VREME</th>
      <th scope="col">CENA</th>
      <th scope="col">IME</th>
      <th scope="col">PREZIME</th>
      <th scope="col">OPCIJE</th>



    </tr>
  </thead>
  <tbody>
  <?php      while($red = $termini->fetch_array()): ?>

                    <tr>
                        <th scope="row"><?php echo $red['id_ter'];   ?></th>
                        <td><?php echo $red['datum'];   ?></td>  
                        <td><?php echo $red['naziv'];   ?></td>  
                        <td><?php echo $red['vreme']  ?></td>
                        <td><?php echo $red['cena']  ?></td> 
                        <td><?php echo $red['ime']  ?></td> 
                        <td><?php echo $red['prezime']  ?></td> 
                        <td>
                            <button type="button" class="btn btn-danger" onclick="obrisiTermin(<?php echo $red['id_ter']?>)">Obrisi</button>
                            <button type="button" class="btn btn-warning">Izmeni</button>
                         </td> 


                    </tr>

                <?php    
                        endwhile;
                ?>
  </tbody>
</table>


    </div>






    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</body>
</html>