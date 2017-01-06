var paquete = [];
$(window).load(function(){
        if($('#modal_upload_result') != null){
            $('#modal_upload_result').modal('show');
        }
    });
    
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
                $('#nit_resultado').html(data["NIT"]);
                $('#nombre_empresa_resultado').val(data["nombre_empresa"]);
                var plan = data["plan"];
                $('#plan_resultado').val('Plan: ' + plan);
                var minutos = '';
                if(plan.indexOf("PM") != -1){
                        minutos = '600 mins';
                }else if(plan.indexOf("MM") != -1){
                        minutos = '1330 mins';
                }else if(plan.indexOf("1E") != -1){
                        minutos = '1880 mins';
                }else if(plan.indexOf("1I") != -1){
                        minutos = '2800 mins';
                }else if(plan.index){
                        minutos = 'NA';
                }
                $('#minutos_resultado').val(minutos);
                $('#valor_resultado').val('Valor: $' + data["valor"]);
                $('#cod_scl_resultado').val('Scl: ' + data["cod_scl"]);
                $('#cod_punto_resultado').val('Punto: ' + data["cod_punto"]);
                $('#direccion_resultado').val(data["direccion_empresa"]);
                $('#fecha_activacion_libre_resultado').val(data["fecha_activacion"]);
                $("#subdistribuidor_libre_resultado").val(data["subdistribuidor"]);
                // RESPONSABLE
                $('#nombre_responsable_resultado').val(data["responsable"]);
                $('#cedula_responsable_resultado').val(data["cedula"]);
                $('#celular_responsable_resultado').val(data["telefono"]);
                $('#ciudad_responsable_resultado').val(data["ciudad_responsable"]);
                $('#barrio_responsable_resultado').val(data["barrio_responsable"]);
                $('#fecha_entrega_libre_resultado').val(data["fecha_entrega"]);
                $('#fecha_llamada_libre_resultado').val(data["fecha_llamada"]);
                $('#detalle_llamada_resultado').val(data["detalle_llamada"]);
                $('#direccion_responsable_resultado').val(data["direccion_responsable"]);
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
            if(data != ''){
                if(paquete.indexOf(data[0].numero) != -1){
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Ya está la simcard');
                    $('#modal-content').modal('show');
                    $('#datos_busqueda_sim_empaquetar').val('');
                    $('#datos_busqueda_sim_empaquetar').focus();
                }else{
                    $('#datos_busqueda_sim_empaquetar').val('');
                    $('#datos_busqueda_sim_empaquetar').focus();
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
                    $('#package_item_counter').html(paquete.length);
                }
            }else{
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Simcard no encontrada');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
        }
    });
});

$('#datos_busqueda_paquete').keyup(function(e){
    if(e.keyCode == 13)
    {
        buscarPaquete();
    }
});

$('#dato_buscar_sim_libre').keyup(function(e){
    if(e.keyCode == 13)
    {
        buscarSim_libre();
    }
});
$('#dato_buscar_sim').keyup(function(e){
    if(e.keyCode == 13)
    {
        buscarSim();
    }
});
$('#datos_busqueda_sim_empaquetar').keyup(function(e){
    if(e.keyCode == 13)
    {
        $(this).trigger("enterKey");
    }
});

function limpiar_paquete(){
    paquete = [];
    $('#package_item_counter').html(paquete.length);
    document.getElementById('container_simcards_empaquetado').innerHTML = '';
}

function empaquetar(){
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    if(paquete.length == 50){
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
                    $('#package_item_counter').html(paquete.length);
                    document.getElementById('container_simcards_empaquetado').innerHTML = '';
                }else{
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('Simcard no encontrada');
                    $('#modal-content').modal('show');
                }
                $('#modal-loading').modal('hide');
            }
        });
    }else{
        $('.modal-header #modal-tittle').html('Error');
        $('.modal-body #modal-body').html('Recuerda que deben ser 50. Tienes: ' + paquete.length);
        $('#modal-content').modal('show');
        $('#modal-loading').modal('hide');
    }
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
                    $('#package_item_counter').html(paquete.length);
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
        $('#modal-loading').modal('hide');
        $('#modal-content').modal('show');
    }
}

function asignar_sim_unidad(){
    $('#modal_seleccionar_subdistri_unidad').modal('hide');
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    var ICC = $('#ICC-resultado').val();
    var sub = $('[data-id="subPicker_unidad"]').text();
    if(ICC != ''){
        $.ajax({
            url:'simcard/asignarUnidad',
            data:{ICC:ICC, sub:sub},
            type:'GET',
            dataType: 'json',
            success: function(data){
                if(data == 1){
                   $('.modal-header #modal-tittle').html('Exito');
                    $('.modal-body #modal-body').html('Simcard asignada satisfactoriamente.');
                    $('#modal-content').modal('show');
                }else{
                    $('.modal-header #modal-tittle').html('Error');
                    $('.modal-body #modal-body').html('error: ' + data);
                    $('#modal-content').modal('show');
                }
                $('#modal-loading').modal('hide');
            }
        });
    }else{
        $('.modal-header #modal-tittle').html('Error');
        $('.modal-body #modal-body').html('Debe ingresar un dato.');
        $('#modal-loading').modal('hide');
        $('#modal-content').modal('show');
    }
}



/**REVISAR ASIGNACIONES **/

var datosDiagrama=[
            {
                value: 1,
                color:"gray",
                highlight: "gray",
            }
        ];
        
var options = {
    segmentShowStroke : true,
    segmentStrokeColor : "#fff",
    segmentStrokeWidth : 2,
    percentageInnerCutout : 50,
    animationSteps : 100,
    animationEasing : "easeOutBounce",
    animateRotate : true,
    animateScale : false,
    responsive:true,
    maintainAspectRatio:false,
    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
    multiTooltipTemplate: "<%=value%>",
}
var ctx = document.getElementById("canvasAsignaciones").getContext("2d");
var diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagrama, options);  
// MORADO - AZUL - VERDE - AMARILLO - ROJO - NARANJA - ROSADO - AGUAMARINA - VERDE SUAVE - MAGENTA - CAFE - AMARRILLO - MORADO -AZUL - VERDE - ROJO
var colors = ['#BDAEC6', '#C1DAD6', '#89E894', '#FFFF66', '#E86850', '#ffb366', '#ff9999', '#66d9ff', '#99ff66', '#F49AC2', '#836953', '#FDFD96', '#B19CD9', '#C1DAD6', '#89E894', '#E86850'];




function consultar_asignaciones(){
    var fecha_inicial = $('#fecha_inicial').val();
    var fecha_final = $('#fecha_final').val();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    datos_asignaciones(null,fecha_inicial, fecha_final);
}

function getId(){
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'simcard/id',
        type:'GET',
        success: function(data){
            if(data < 0){
                $('.modal-body #modal-id-body').html(data);
            }
            $('#modal-loading').modal('hide');
        }
     });
}

function descargar_libres_admin(){
    var distribuidor = $('[data-id="subPicker_distri_libres"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
         $.ajax({
            url:'simcard/descargarLibres',
            data:{distribuidor:distribuidor},
            type:'GET',
            success: function(data){
                if(data == 1){
                    document.getElementById('my_iframe').src = "temp/simcardsLibres.csv"; 
                }
                $('#modal-loading').modal('hide');
            }
         });
}

function descargar_asignaciones_admin(){
    var distribuidor = $('[data-id="subPicker_distri"]').text();
    var fecha_inicial = $('#fecha_inicial').val();
    var fecha_final = $('#fecha_final').val();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
         $.ajax({
            url:'simcard/asignaciones',
            data:{distribuidor:distribuidor,fecha_inicial:fecha_inicial,fecha_final:fecha_final},
            type:'GET',
            success: function(data){
                if(data == 1){
                    document.getElementById('my_iframe').src = "temp/asignacionesSimcards.csv"; 
                }
                $('#modal-loading').modal('hide');
            }
         });
}

function consultar_asignaciones_admin(){
    var distribuidor = $('[data-id="subPicker_distri"]').text();
    if(distribuidor.indexOf("TODOS") != -1){
        alert("No puede seleccionar todos en consultar, descarge el archivo")
    }else{
        var fecha_inicial = $('#fecha_inicial').val();
        var fecha_final = $('#fecha_final').val();
        $('#modal-loading').modal({
            backdrop: 'static',
            keyboard: false
            })
        datos_asignaciones(distribuidor,fecha_inicial, fecha_final);
    }
}

function datos_asignaciones(distribuidor,fecha_inicial,fecha_final){
    $.ajax({
        url:'diagrama/asignaciones',
        data:{distribuidor:distribuidor, fecha_inicial:fecha_inicial, fecha_final:fecha_final},
        type:'GET',
        success: function(data){
            var datos = new Map();
            var datosDiagrama = [];
            var totalPrepago = 0;
            var totalLibre = 0;
            var html = "";
            var aux;
            var aux2;
            if(data.length == 0){
                $('#asignaciones_container').html('<label style="color:red;font-size:18px">No tienes simcards asignadas</label>');
                $('#modal-loading').modal('hide');
                return;
            }
            for (var i = 0; i < data.length; i++){
                if(!datos.has(data[i].nombre)){
                    aux = new Map();
                    aux.set(data[i].fecha_entrega, [0,0]);
                }else{
                    aux = datos.get(data[i].nombre);
                    if(!aux.has(data[i].fecha_entrega)){
                        aux.set(data[i].fecha_entrega, [0,0]);
                    }
                }
                aux2 = aux.get(data[i].fecha_entrega);
                if(data[i].tipo == 1){
                    aux2[0] = data[i].cantidad;
                }else{
                    aux2[1] = data[i].cantidad;
                    
                }
                aux.set(data[i].fecha_entrega, aux2);
                datos.set(data[i].nombre,aux);
            }
            var i = 0;
            datos.forEach(function(values, key) {
                html +=  '<div class="historial_container" style="background: ' + colors[i] + '">' + '<label style="min-width:200px">'  + key + '</label><hr>';
                values.forEach(function(values, key) {
                    html += '<label style="min-width:200px">' + key + '</label><hr><label class="historial_label" style="margin-right:10px;">' + values[0] + '</label><label class="historial_label">' + values[1] + '</label><br>';
                    totalPrepago += values[0];
                    totalLibre += values[1];
                }, values)
                html += '</div><br>';
                i++;
            }, datos)
            
            html += '<h3 class="section-heading text-muted" style="color:black;margin-bottom:20px">TOTAL ASIGNACIONES</h3><hr><label class="historial_label_total">' + (totalPrepago+totalLibre) + '</label>';
            var total=totalPrepago+totalLibre;
            datosDiagrama.push(
                        {
                            value: totalLibre,
                            color:"#85C1F5",
                            highlight: "#4A789C",
                            label: "Libre",
                        }
                    );
            datosDiagrama.push(
                        {
                            value: totalPrepago,
                            color:"#7FCA9F",
                            highlight: "#3f654f",
                            label: "Prepago",
                        }
                    );
            $('#asignaciones_container').html(html);
            diagramaPrepVsLibre.destroy();
            var ctx = document.getElementById("canvasAsignaciones").getContext("2d");
            diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagrama, options);
            $('#modal-loading').modal('hide');
        }
    });  
}

function descargar_proximas_vencer(){
    var fecha_inicial = $('#fecha_inicial_vencimiento').val();
    var fecha_final = $('#fecha_final_vencimiento').val();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'simcard/descargarVencimiento',
        data:{distribuidor:null,fecha_inicial:fecha_inicial, fecha_final:fecha_final},
        type:'GET',
        success: function(data){
            if(data != 1){
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html(data);
                $('#modal-content').modal('show'); 
            }else{
                document.getElementById('my_iframe').src = "temp/simcardsVencer.csv";  
            }
            $('#modal-loading').modal("hide");
        }
    });
}

function descargar_proximas_vencer_admin(){
    var fecha_inicial = $('#fecha_inicial_vencimiento').val();
    var fecha_final = $('#fecha_final_vencimiento').val();
    var distribuidor = $('[data-id="subPicker_distri_vencimiento"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'simcard/descargarVencimiento',
        data:{distribuidor:distribuidor,fecha_inicial:fecha_inicial, fecha_final:fecha_final},
        type:'GET',
        success: function(data){
            if(data != 1){
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html(data);
                $('#modal-content').modal('show'); 
            }else{
                document.getElementById('my_iframe').src = "temp/simcardsVencer.csv";  
            }
            $('#modal-loading').modal("hide");
        }
    });
}