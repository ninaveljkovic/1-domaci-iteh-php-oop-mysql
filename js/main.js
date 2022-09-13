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
