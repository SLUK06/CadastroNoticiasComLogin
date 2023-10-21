$("#Email").keyup(function(){
    var email = $(this).val();
    $.post('../Config/VerificaEmail.php', {'email' : email}, function(data){
        $('#ResultadoEmail').html(data);
    });  
});

$("#Usuario").keyup(function(){
    var usuario = $(this).val();
    $.post('../Config/VerificaUsuario.php', {'usuario' : usuario}, function(data){
        $('#ResultadoUsuario').html(data);
    });
})