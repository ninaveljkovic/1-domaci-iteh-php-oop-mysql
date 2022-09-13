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