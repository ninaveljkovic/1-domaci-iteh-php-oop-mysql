function obrisiTermin(id){
    req = $.ajax({
        url: 'handler/delete.php',
        type: 'post',
        data: { 'id': id }
    });

    req.done(function (res, textStatus, jqXHR) {
        if (res == "Success") {
            location.reload(true);
            alert('Uspesno obrisano iz baze!');
            
        } else {
            console.log("neuspesno brisanje " + res);
            alert("neuspesno brisanje ");

        }
         
    });
}


//za dodaj novu rezervaciju modal
//
$('#rezervisi').submit(function () {
   
  
    event.preventDefault(); //zaustavi refresovanje na stranici
   
    const $form = $(this);//this se odnosi na formu #rezervisi
    const $input = $form.find('input,select,button,textarea');
    const serijalizacija = $form.serialize(); //serijalizujemo podatke iz forme i saljemo ih nasem postu

    
  
    $input.prop('disabled', true); //na sve inpute postavljamo property da onemogucimo da korisnik menja ono sto je uneo dok se ne zavrsi ubacivanje u tabelu


    request = $.ajax({  
        url: 'handler/add.php',  
        type: 'post',
        data: serijalizacija
    });

    request.done(function (response, textStatus, jqXHR) {
        console.log(response)
       
        if (response === "Success") {
            alert("Uspesno rezervisano");
            console.log("Uspesno rezervisano");
            location.reload(true);
        }
        else {
       
            console.log("Rezervacija nije dodata" + response);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        
        console.error('Greska: ' + textStatus, errorThrown);
    });
});

function prikazi(id){

     
    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: { 'id': id },
        dataType: 'json'
    });


    request.done(function (response, textStatus, jqXHR) {
 
        console.log(response)

       $('#skrivenoPoljeID').val(response[0]["id_ter"]); //skriveno polje 
 
        
       $('#zaposleniE').val(response[0]["id"]).change(); 
 

       $('#tretmaniE').val(response[0]["id_friz"]);
 

        $('#datumE').val(response[0]['datum'].trim());   
 
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });
}




//sada kada korisnik unese neke izmene hocemo da klikom na dugme potvrdi te izmene zaista unesemo u bazu
$('#izmeni').submit(function () { //kada korisnik klikne dugme unutar modala

    event.preventDefault();

    const $form =  $(this);
   
    const $inputs = $form.find('input, select, button, textarea');
    
    const serializedData = $form.serialize();
   
    $inputs.prop('disabled', true);

  
    request = $.ajax({
        url: 'handler/edit.php',
        type: 'post',
        data: serializedData
    })

    request.done(function (response, textStatus, jqXHR) {
        console.log(response);
     
        $('#editModal').modal('hide');
        location.reload(true);
        $('#izmeni').reset;

    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });



});

//funkcija za soritranje tretmana po ceni 
function sortiraj() {
    
    console.log(document.getElementById("poredak").value)
   if(document.getElementById("poredak").value=="asc"){
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("tabelaTermina");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[3];
        y = rows[i + 1].getElementsByTagName("TD")[3];
        // Check if the two rows should switch place:
        console.log(x)

        if (x.innerHTML > y.innerHTML) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
    document.getElementById("poredak").value="desc";
   }else{
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("tabelaTermina");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[3];
        y = rows[i + 1].getElementsByTagName("TD")[3];
        // Check if the two rows should switch place:
        console.log(x)

        if (x.innerHTML < y.innerHTML) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
    document.getElementById("poredak").value="asc";
   }

}
