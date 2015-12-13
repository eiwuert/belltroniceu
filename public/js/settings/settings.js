$(document).ready(function () {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    $( "#new_user_name" ).keyup(function() {
        if($( "#new_user_name" ).val() == ''){
            $( "#new_user_email").val('');
        }else{
            $( "#new_user_email").val($('#new_user_name').val()+'@hotmail.com');
        }
    });
});
function crear_usuario(){
    var name = $('#new_user_name').val();
    var email = $('#new_user_email').val();
    var admin = 1;
    if($('#off').is(':checked')) {
       admin = 0
    }
    if(email == '' || name == ''){
        $('.modal-header #modal-tittle').html('Error');
        $('.modal-body #modal-body').html('Existen campos sin datos');
        $('#modal-content').modal('show');  
    }else{
        $.ajax({
            url:'user/crear',
            data:{email:email, name:name, admin:admin},
            type:'POST',
            dataType: 'json',
            success: function(data){
                if(data == 1){
                    $('.modal-header #modal-tittle').html('Exito');
                    $('.modal-body #modal-body').html('Usuario creado');
                    $('#modal-content').modal('show');
                }else if(data == -1){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Ya existe un usuario con ese email');
                    $('#modal-content').modal('show');       
                }else if(data == -2){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Ya existe un usuario con ese nombre');
                    $('#modal-content').modal('show');       
                }else{
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Error al ingresar: ' + data);
                    $('#modal-content').modal('show');       
                }
            }
        });
    }
}
function actualizar_usuario(){
    var email = $('#user_email').val();
    var password = $('#user_password').val();
    var new_password = $('#user_new_password').val();
    if(email == '' || password == ''){
        $('.modal-header #modal-tittle').html('Error');
        $('.modal-body #modal-body').html('Existen campos sin datos');
        $('#modal-content').modal('show');  
    }else if(new_password.length < 5 && new_password.length > 0 ){
        $('.modal-header #modal-tittle').html('Error');
        $('.modal-body #modal-body').html('La contraseña debe tener mas de 5 caracteres');
        $('#modal-content').modal('show');  
    }else{
        $.ajax({
            url:'user/actualizar',
            data:{email:email, password:password, new_password:new_password},
            type:'POST',
            dataType: 'json',
            success: function(data){
                if(data == 1){
                    $('.modal-header #modal-tittle').html('Exito');
                    $('.modal-body #modal-body').html('Datos actualizados');
                    $('#modal-content').modal('show');
                }else if(data == -1){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Contraseña equivocada');
                    $('#modal-content').modal('show');       
                }else if(data == -2){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Email ya existente');
                    $('#modal-content').modal('show');
                }
            }
        });
    }
}