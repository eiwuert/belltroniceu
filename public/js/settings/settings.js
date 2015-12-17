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

function crear_subdistribuidor(){
    var distribuidor =  $('#subPicker_distri option:selected').val();
    var nombre = $('#new_subdistribuidor_name').val();
    if(nombre == ''){
        $('.modal-header #modal-tittle').html('Error');
        $('.modal-body #modal-body').html('Existen campos sin datos');
        $('#modal-content').modal('show');  
    }else{
        $('#modal-loading').modal({
            backdrop: 'static',
            keyboard: false
        })
        $.ajax({
            url:'subdistribuidor/crear',
            data:{distribuidor:distribuidor, nombre:nombre},
            type:'GET',
            dataType: 'json',
            success: function(data){
                if(data == 1){
                    $('.modal-header #modal-tittle').html('Exito');
                    $('.modal-body #modal-body').html('Subdistribuidor creado');
                    $('#modal-content').modal('show');
                }else if(data == -1){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Ya existe un usuario con ese email');
                    $('#modal-content').modal('show');       
                }else{
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Error al ingresar: ' + data);
                    $('#modal-content').modal('show');       
                }
                $('#modal-loading').modal('hide');
            }
        });
    }
}
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
        $('#modal-loading').modal({
            backdrop: 'static',
            keyboard: false
        })
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
                $('#modal-loading').modal('hide');
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
        $('#modal-loading').modal({
            backdrop: 'static',
            keyboard: false
        })
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
                $('#modal-loading').modal('hide');
            }
        });
    }
}

function borrar_subdistribuidor(tag){
    var aux = tag.split("_");
    var nombre = aux[0];
    if(confirm('Esta seguro?')){
        $('#modal-loading').modal({
            backdrop: 'static',
            keyboard: false
        })
        $.ajax({
            url:'subdistribuidor/eliminar',
            data:{nombre:nombre},
            type:'GET',
            dataType: 'json',
            success: function(data){
                if(data == 1){
                    $('.modal-header #modal-tittle').html('Exito');
                    $('.modal-body #modal-body').html('Subdistribuidor eliminado');
                    $('#modal-content').modal('show');
                }else{
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html(data);
                    $('#modal-content').modal('show');       
                }
                $('#'+nombre).parent().remove();
                $('#modal-loading').modal('hide');
            }
        });
    }
}


function borrar_distribuidor(tag){
    var aux = tag.split("_");
    var nombre = aux[1];
    if(confirm('Esta seguro?')){
        $('#modal-loading').modal({
            backdrop: 'static',
            keyboard: false
        })
        $.ajax({
            url:'user/eliminar',
            data:{nombre:nombre},
            type:'GET',
            dataType: 'json',
            success: function(data){
                if(data == 1){
                    $('.modal-header #modal-tittle').html('Exito');
                    $('.modal-body #modal-body').html('Distribuidor eliminado');
                    $('#modal-content').modal('show');
                }else{
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html(data);
                    $('#modal-content').modal('show');       
                }
                $('#'+nombre).parent().parent().remove();
                $('#modal-loading').modal('hide');
            }
        });
    }
}

function actualizar_subdistribuidor(tag){
    var aux = tag.split("_");
    var nombre = aux[0];
    var nuevo_nombre = document.getElementById(nombre).value;
    if(confirm('Esta seguro?')){
        $('#modal-loading').modal({
            backdrop: 'static',
            keyboard: false
        })
        $.ajax({
            url:'subdistribuidor/actualizar',
            data:{nombre:nombre, nuevo_nombre:nuevo_nombre},
            type:'GET',
            dataType: 'json',
            success: function(data){
                if(data == 1){
                    $('.modal-header #modal-tittle').html('Exito');
                    $('.modal-body #modal-body').html('Subdistribuidor actualizado');
                    $('#modal-content').modal('show');
                }else if(data == -1){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html("YA EXISTE ESE NOMBRE EN EL SISTEMA");
                    $('#modal-content').modal('show');  
                }else{
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html(data);
                    $('#modal-content').modal('show');       
                }
                $('#modal-loading').modal('hide');
            }
        });
    }
}