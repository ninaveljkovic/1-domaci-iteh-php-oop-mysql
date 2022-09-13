<?php
    include 'dbbroker.php';
    include 'model/Termin.php'; 
    include 'model/Frizura.php'; 
    include 'model/Zaposleni.php'; 

  

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
   <br><br><br>
    <div class="container">
    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#addModal">Dodaj novi termin</button>
    <button type="button" class="btn btn-success" onclick="sortiraj()">Sortiraj</button>
    <input type="hidden" id="poredak" value="asc"> 
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchbar">

    <table class="table" id="tabelaTermina">
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
  <tbody id="teloTabele">
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
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="prikazi(<?php echo $red['id_ter']?>)">Izmeni</button>
                         </td> 


                    </tr>

                <?php    
                        endwhile;
                ?>
  </tbody>
</table>


    </div>


 <!-- Modal za rezervisanje novog termina -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rezervisi novi termin </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="rezervisi" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                                 


                              <div class="form-group">
                                      <label for="tretmani">Odaberi frizuru</label><br>
                                      <select name="tretmani" id="tretmani">
                                      <?php
                                          $frizure = Frizura::vratiSveFrizure($conn);
                                        while($red = $frizure->fetch_array()):
                                          $nazivTretmana=$red["naziv"];
                                            echo  $nazivTretmana;
                                      ?>
                                      
                                        <option value=<?php echo $red["id_friz"]?>><?php echo $red["naziv"]?></option>


                                        <?php   endwhile;   ?>
                                      </select>
                                </div>

                                <div class="form-group">
                                      <label for="zaposleni">Odaberi frizera</label><br>
                                      <select name="zaposleni" id="zaposleni">
                                      <?php
                                          $zaposleni = Zaposleni::vratiSveZaposlene($conn);
                                        while($red = $zaposleni->fetch_array()):   ?>
                                      
                                        <option value=<?php echo $red["id"]?>><?php echo $red["ime"]." ".$red["prezime"]?></option>


                                        <?php   endwhile;   ?>
                                      </select>
                                </div>
 
                           
                             
                            
                            
                                <div class="form-group">
                                        <label for="message-text" class="col-form-label">Datum rezervacije</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="date" id="datum" name="datum" class="form-control"  required="required" />
                                            </div>
                                        </div>
                                </div>
  
         

                       
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Odustani</button>
                            <button type="submit" class="btn btn-success" id="addButton">Potvrdi</button>
                        </div>



                    </form>
                    </div>
              
           
                </div>
            </div>

 <!-- kraj Modala za rezervisanje novog termina -->

 <!-- Modal za izmenu termina -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Izmeni termin </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="izmeni" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                                 


                              <div class="form-group">
                                      <label for="tretmaniE">Odaberi frizuru</label><br>
                                      <select name="tretmaniE" id="tretmaniE">
                                      <?php
                                          $frizure = Frizura::vratiSveFrizure($conn);
                                        while($red = $frizure->fetch_array()):
                                          $nazivTretmana=$red["naziv"];
                                            echo  $nazivTretmana;
                                      ?>
                                      
                                        <option value=<?php echo $red["id_friz"]?>><?php echo $red["naziv"]?></option>


                                        <?php   endwhile;   ?>
                                      </select>
                                </div>

                                <div class="form-group">
                                      <label for="zaposleniE">Odaberi frizera</label><br>
                                      <select name="zaposleniE" id="zaposleniE">
                                      <?php
                                          $zaposleni = Zaposleni::vratiSveZaposlene($conn);
                                        while($red = $zaposleni->fetch_array()):   ?>
                                      
                                        <option value=<?php echo $red["id"]?>><?php echo $red["ime"]." ".$red["prezime"]?></option>


                                        <?php   endwhile;   ?>
                                      </select>
                                </div>
                                
                           
                             
                            
                            
                                <div class="form-group">
                                        <label for="message-text" class="col-form-label">Datum rezervacije</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="date" id="datumE" name="datumE" class="form-control"  required="required" />
                                            </div>
                                        </div>
                                </div>
  
                                <input type="hidden" id="skrivenoPoljeID" name="skrivenoPoljeID" class="form-control"   />

                       
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Odustani</button>
                            <button type="submit" class="btn btn-success"  >Potvrdi</button>
                        </div>



                    </form>
                    </div>
              
           
                </div>
            </div>

 <!-- kraj Modala za izmenu termina -->



    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>
</html>