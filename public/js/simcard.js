var paquete = [];

function seleccionar_distribuidor(objButton){
    $('#distribuidor-resultado').html(objButton.value);
    $('#modal-distribuidor').modal('hide');
    var subdistribuidorContainer = $('#modal-body-subdistribuidores');
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url: 'subdistribuidor/buscarTodos',
        data:{distribuidor:objButton.value},
        type: "GET", // not POST, laravel won't allow it
        success: function(data){
            $('#modal-body-subdistribuidores').html(data);    
            $('#subdistribuidor-resultado').html('SELECCIONA');
            $('#modal-loading').modal('hide');
        }
      });
}

function seleccionar_sub(objButton){
    $('#subdistribuidor-resultado').html(objButton.value);
    $('#modal-subdistribuidor').modal('hide');
}
function buscarSim_libre(){
    var dato = document.getElementById("dato_buscar_sim_libre").value;
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/buscarLibre',
        data:{dato:dato},
        type:'GET',
        dataType: 'json',
        success: function(data){
            if(data != ''){
                $('#nit_resultado').html(data[0].NIT);
                $('#nombre_empresa_resultado').val(data[0].nombre_empresa);
                $('#plan_resultado').val('Plan: ' + data[0].plan);
                $('#valor_resultado').val('Valor: $' + data[0].valor);
                $('#cod_scl_resultado').val('Scl: ' + data[0].cod_scl);
                $('#cod_punto_resultado').val('Punto: ' + data[0].cod_punto);
                $('#direccion_resultado').val(data[0].direccion_empresa);
                $('#fecha_activacion_libre_resultado').val(data[0].fecha_activacion);
                // RESPONSABLE
                $('#nombre_responsable_resultado').val(data[0].responsable);
                $('#cedula_responsable_resultado').val(data[0].cedula);
                $('#celular_responsable_resultado').val(data[0].telefono);
                $('#ciudad_responsable_resultado').val(data[0].ciudad_responsable);
                $('#barrio_responsable_resultado').val(data[0].barrio_responsable);
                $('#fecha_entrega_libre_resultado').val(data[0].fecha_entrega);
                $('#fecha_llamada_libre_resultado').val(data[0].fecha_llamada);
                $('#detalle_llamada_resultado').val(data[0].detalle_llamada);
            }else{
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Simcard no encontrada');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
        }
    });
}

function guardar_responsable(){
    var dato = [];
    dato.push(document.getElementById("dato_buscar_sim_libre").value);
    dato.push($('#nombre_responsable_resultado').val());
    dato.push($('#cedula_responsable_resultado').val());
    dato.push($('#celular_responsable_resultado').val());
    dato.push($('#ciudad_responsable_resultado').val());
    dato.push($('#barrio_responsable_resultado').val());
    dato.push($('#fecha_entrega_libre_resultado').val());
    dato.push($('#fecha_llamada_libre_resultado').val());
    dato.push($('#detalle_llamada_resultado').val());
    dato.push($('#direccion_responsable_resultado').val());
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/actualizarLibre',
        data:{dato:dato},
        type:'GET',
        dataType: 'json',
        success: function(data){
            if(data != ''){
                $('.modal-header #modal-tittle').html('Exito');
                $('.modal-body #modal-body').html('Datos actualizados');
                $('#modal-content').modal('show');
            }else{
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Error actualizando datos');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
            $('#modal-cliente_libre').modal('hide');
        }
    });
}
function buscarSim(){
    var dato = document.getElementById("dato_buscar_sim").value;
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/buscar',
        data:{dato:dato},
        type:'GET',
        dataType: 'json',
        success: function(data){
            if(data != ''){
                var today = new Date();
                $('#ICC').val(data[0].ICC);
                $('#telefono').val(data[0].numero);
                $('#ICC-resultado').val(data[0].ICC);
                $('#telefono-resultado').val(data[0].numero);
                if(data[0].paquete != -1){
                    $('#paquete-resultado').val(data[0].paquete);
                }else{
                    $('#paquete-resultado').val('NA');
                }
                if(data[0].tipo == 1){
                    $('#tipo-resultado').val('PREPAGO PACK');    
                }else{
                    $('#tipo-resultado').val('LIBRE');
                }
                $('#distribuidor-resultado').html(data[0].name);
                $('#subdistribuidor-resultado').html(data[0].nombreSubdistribuidor);
                $('#fecha_vencimiento-resultado').val(data[0].fecha_vencimiento);
                $('#fecha_activacion-resultado').val(data[0].fecha_activacion);
                $('#fecha_entrega-resultado').val(data[0].fecha_entrega);
                $.ajax({
                    url: 'subdistribuidor/buscarTodos',
                    data:{distribuidor:data[0].name},
                    type: "GET", // not POST, laravel won't allow it
                    success: function(data){
                        $('#modal-body-subdistribuidores').html(data);    
                    }
                });
                var fecha_vencimiento_string = data[0].fecha_vencimiento.split("-");
                var fecha_vencimiento = new Date(fecha_vencimiento_string[0], fecha_vencimiento_string[1]-1,fecha_vencimiento_string[2]);
                var months = dayDiff(today, fecha_vencimiento);
                if( data[0].fecha_activacion != null){
                    if(months > 0){
                        changeClass("green");
                    }else{
                        changeClass("red");
                    }
                }else{
                    if(months > 0){
                       changeClass("blue"); 
                    }else{
                       changeClass("red");
                    }
                }
            }else{
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Simcard no encontrada');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
        }
    });
}
function changeClass(color){
    $("#ICC-container").attr("class", color);
    $("#telefono-container").attr("class", color);
    $("#paquete-container").attr("class", color);
    $("#tipo-container").attr("class", color);
    $("#distribuidor-container").attr("class", color);
    $("#subdistribuidor-container").attr("class", color);
    $("#fecha_vencimiento-container").attr("class", color);
    $("#fecha_activacion-container").attr("class", color);
    $("#fecha_entrega-container").attr("class", color);
    $("#search_container").attr("class", color + " search_container");
}
function dayDiff(d1, d2) {
     return Math.round((d2-d1)/(1000*60*60*24));
}

function limpiar_campos(){
    $('#ICC-resultado').val('');
    $('#telefono-resultado').val('');
    $('#paquete-resultado').val('');
    $('#tipo-resultado').val('');
    $('#fecha_vencimiento-resultado').val('');
    $('#fecha_activacion-resultado').val('');
    $('#fecha_entrega-resultado').val('');
    $('#dato_buscar_sim').val('');
    changeClass("gray"); 
}

function limpiar_campos_libre(){
    $('#dato_buscar_sim_libre').val('');
    $('#nit_resultado').html('NIT');
    $('#nombre_empresa_resultado').val('');
    $('#plan_resultado').val('');
    $('#valor_resultado').val('');
    $('#cod_scl_resultado').val('');
    $('#cod_punto_resultado').val('');
    $('#direccion_resultado').val('');
    $('#fecha_activacion_libre_resultado').val('');
    // RESPONSABLE
    $('#nombre_responsable_resultado').val('');
    $('#cedula_responsable_resultado').val('');
    $('#celular_responsable_resultado').val('');
    $('#ciudad_responsable_resultado').val('');
    $('#barrio_responsable_resultado').val('');
    $('#fecha_entrega_libre_resultado').val('');
    $('#fecha_llamada_libre_resultado').val('');
    $('#detalle_llamada_resultado').val('');
}

/*  SECCION PAQUETE   */

function buscarPaquete(){
    var dato_paquete = $('#datos_busqueda_paquete').val();
    if(dato_paquete != ''){
        $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
        $.ajax({
            url:'simcard/buscarPaquete',
            data:{dato_paquete:dato_paquete},
            type:'GET',
            success: function(data){
                if(data != []){
                    $('#container_simcards_paquete').html(data);    
                }else{
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Paquete no encontrado');
                    $('#modal-content').modal('show');
                    $('#container_simcards_paquete').html("");   
                }
                $('#modal-loading').modal('hide');
            }
        });
    }
}

function seleccionarSim(btnObj){
    var telefono = btnObj.value;
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/buscar',
        data:{dato:telefono},
        type:'GET',
        dataType: 'json',
        success: function(data){
            if(data != ''){
                var today = new Date();
                $('#dato_buscar_sim').val('');  
                $('#ICC').val(data[0].ICC);
                $('#telefono').val(data[0].numero);
                $('#ICC-resultado').val(data[0].ICC);
                $('#telefono-resultado').val(data[0].numero);
                $('#paquete-resultado').val(data[0].paquete);
                if(data[0].tipo == 1){
                    $('#tipo-resultado').val('PREPAGO PACK');    
                }else{
                    $('#tipo-resultado').val('LIBRE');
                }
                $('#distribuidor-resultado').html(data[0].name);
                $('#subdistribuidor-resultado').html(data[0].nombreSubdistribuidor);
                $('#fecha_vencimiento-resultado').val(data[0].fecha_vencimiento);
                $('#fecha_activacion-resultado').val(data[0].fecha_activacion);
                $.ajax({
                    url: 'subdistribuidor/buscarTodos',
                    data:{distribuidor:data[0].name},
                    type: "GET", // not POST, laravel won't allow it
                    success: function(data){
                        $('#modal-body-subdistribuidores').html(data);    
                    }
                  });
                  var fecha_vencimiento_string = data[0].fecha_vencimiento.split("-");
                    var fecha_vencimiento = new Date(fecha_vencimiento_string[0], fecha_vencimiento_string[1]-1,fecha_vencimiento_string[2]);
                    var months = dayDiff(today, fecha_vencimiento);
                    if( data[0].fecha_activacion != null){
                        if(months > 0){
                            changeClass("green");
                        }else{
                            changeClass("red");
                        }
                    }else{
                        if(months > 0){
                           changeClass("blue"); 
                        }else{
                           changeClass("red");
                        }
                    }
                  $('html, body').animate({
                    scrollTop: $("#buscar").offset().top
                    }, 500);
            }else{
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Simcard no encontrada');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
        }
    });
}

$('#datos_busqueda_sim_empaquetar').bind("enterKey",function(e){
   var telefono = $('#datos_busqueda_sim_empaquetar').val();
   $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/buscar',
        data:{dato:telefono},
        type:'GET',
        dataType: 'json',
        success: function(data){
            $('#datos_busqueda_sim_empaquetar').val('');
            $('#datos_busqueda_sim_empaquetar').focus();
            if(data != ''){
                var today = new Date();
                var fecha_vencimiento_string = data[0].fecha_vencimiento.split("-");
                var fecha_vencimiento = new Date(fecha_vencimiento_string[0], fecha_vencimiento_string[1]-1,fecha_vencimiento_string[2]);
                var months = dayDiff(today, fecha_vencimiento);
                var color;
                if( data[0].fecha_activacion != null){
                    if(months > 0){
                        color = 'green';
                    }else{
                        color = 'red';
                    }
                }else{
                    if(months > 0){
                       color = 'blue'; 
                    }else{
                       color = 'red';
                    }
                }
                var element = '<button class="button_simcards ' + color +' " style="flex-grow:2;width:auto;color:#000;font-weight:normal;font-size:1em" onClick="seleccionarSim(this)" value = ' + data[0].numero + '> ' + data[0].numero  + '</button>';
                document.getElementById('container_simcards_empaquetado').innerHTML += element;
                paquete.push(data[0].numero);
            }else{
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Simcard no encontrada');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
        }
    });
});
$('#datos_busqueda_sim_empaquetar').keyup(function(e){
    if(e.keyCode == 13)
    {
        var telefono = $('#datos_busqueda_sim_empaquetar').val();
        if(paquete.indexOf(telefono) != -1){
            $('.modal-header #modal-tittle').html('Error');
            $('.modal-body #modal-body').html('Ya está la simcard');
            $('#modal-content').modal('show');
            $('#datos_busqueda_sim_empaquetar').val('');
            $('#datos_busqueda_sim_empaquetar').focus();
        }else{
            $(this).trigger("enterKey");
        }
    }
});

function limpiar_paquete(){
    paquete = [];
    document.getElementById('container_simcards_empaquetado').innerHTML = '';
}

function empaquetar(){
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/empaquetar',
        data:{datos:paquete},
        type:'GET',
        dataType: 'json',
        success: function(data){
            if(data != -1){
               $('.modal-header #modal-tittle').html('Exito');
                $('.modal-body #modal-body').html('Simcards empaquetadas. Desde ahora puedes buscarlas en la sección de paquetes.');
                $('#modal-content').modal('show');
                paquete = [];
                document.getElementById('container_simcards_empaquetado').innerHTML = '';
            }else{
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Simcard no encontrada');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
        }
    });
}

function asignar_paquete(){
    $('#modal_seleccionar_subdistri').modal('hide');
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    var dato = $('#datos_busqueda_paquete').val();
    var sub = $('[data-id="subPicker"]').text();
    if(dato != ''){
        $.ajax({
            url:'simcard/asignarPaquete',
            data:{dato:dato, sub:sub},
            type:'GET',
            dataType: 'json',
            success: function(data){
                if(data == 1){
                   $('.modal-header #modal-tittle').html('Exito');
                    $('.modal-body #modal-body').html('Paquete asignado satisfactoriamente.');
                    $('#modal-content').modal('show');
                    paquete = [];
                    document.getElementById('container_simcards_empaquetado').innerHTML = '';
                }else if(data == -1){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('No se encontro la simcard de base.');
                    $('#modal-content').modal('show');
                }else if(data == -2){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('La simcard de base no tiene paquete.');
                    $('#modal-content').modal('show');
                }
                $('#modal-loading').modal('hide');
            }
        });
    }else{
        $('.modal-header #modal-tittle').html('Error');
        $('.modal-body #modal-body').html('Debe ingresar un dato.');
        $('#modal-content').modal('show');
    }
}

function subir_archivo(){
    if (window.File && window.FileReader && window.FileList && window.Blob) {
      $('#fileinput').trigger('click'); 
    } else {
      alert('The File APIs are not fully supported in this browser.');
    }
}

function updateFinish(evt) {
    
   var lines = this.result.split('\n');
   if(lines[0].indexOf('AGREGAR') != -1){
        for(var line = 1; line < lines.length; line++){
            $.ajax({
                url:'simcard/agregar',
                data:{dato:lines[line]},
                type:'GET',
                dataType: 'json',
                success: function(data){
                    if(data != 1){
                        $('.modal-header #modal-tittle').html('Error');
                        $('.modal-body #modal-body').html('Simcard no agregada');
                        $('#modal-content').modal('show');
                    }
                }
            });  
        }
        $('.modal-header #modal-tittle').html('Exito');
        $('.modal-body #modal-body').html('Simcards agregadas');
        $('#modal-content').modal('show');
    }else if(lines[0].indexOf('ACTIVAR') != -1){
        for(var line = 1; line < lines.length; line++){
            $.ajax({
                url:'simcard/activar',
                data:{dato:lines[line]},
                type:'GET',
                dataType: 'json',
                success: function(data){
                    if(data != 1){
                        $('.modal-header #modal-tittle').html('Error');
                        $('.modal-body #modal-body').html('Simcard no agregada');
                        $('#modal-content').modal('show');
                    }
                }
            });  
        }
        $('.modal-header #modal-tittle').html('Exito');
        $('.modal-body #modal-body').html('Simcard activadas');
        $('#modal-content').modal('show');
    }else{
        $('.modal-header #modal-tittle').html('Error');
        $('.modal-body #modal-body').html('Olvido la cabezera que indica la acción.');
        $('#modal-content').modal('show');
    }
    $('#modal-loading').modal('hide');
}

function handleFileSelect(evt) {
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    var reader = new FileReader();
    
    // Closure to capture the file information.
    reader.onload = updateFinish;
     reader.readAsText(evt.target.files[0]);
}
document.getElementById('fileinput').addEventListener('change', handleFileSelect, false);