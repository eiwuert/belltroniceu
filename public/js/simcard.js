

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

function printDonnutChart(data,tipo){
    var data = [
            {
                value: data[0],
                color:"#ff656c",
                highlight: "#7f3236",
                label: "Vencidas",
            },
            {
                value: data[1],
                color: "#85C1F5",
                highlight: "#4A789C",
                label: "Disponibles"
            },
            {
                value: data[2],
                color: "#7FCA9F",
                highlight: "#3f654f",
                label: "Activas"
            }
        ];
        
        var options ={
            segmentShowStroke : true,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 2,
            percentageInnerCutout : 50, 
            animationSteps : 100,
            animationEasing : "easeOutBounce",
            animateRotate : true,
            animateScale : true,
            responsive:true,
        };
        if(tipo == 1){
            var ctx = document.getElementById("canvas_estado_subs").getContext("2d");
            donnutChart = new Chart(ctx).Doughnut(data,options);
        }else{
            var ctx = document.getElementById("canvas_estado_subs_libres").getContext("2d");
            donnutChartLibres = new Chart(ctx).Doughnut(data,options);
        }
}

function estadoSimSubDistri(){
    var sub = $('[data-id="subPicker"]').text();
    var dateSub = $('#dateSub').val();
    if(dateSub != ''){
        $.ajax({
            url:'diagrama/simcardsSub',
            data:{subdistribuidor:sub,requestDate:dateSub},
            type:'GET',
            success: function(data){
                donnutChart.destroy();
                donnutChartLibres.destroy();
                printDonnutChart(data,1);
                printDonnutChart([100,100,100],2);
            }
        });
    }
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
                var today = new Date();
                $('#datos_busqueda_sim_empaquetar').val('');  
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
        $(this).trigger("enterKey");
    }
});