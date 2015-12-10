var firstTime = true;
var donnutChart;
var donnutChartLibres;

$(document).ready(function(){
    $.ajax({
        url:'diagrama/simcards',
        type:'GET',
        success: function(data){
            var datos = {
                labels: [data[1][0], data[1][1], data[1][2]],
                datasets: [
                    {
                        label: "Vencidas",
                        fillColor: "#ff656c",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "#7f3236",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: [data[0][3],data[0][4],data[0][5]]
                    },
                    {
                        label: "Disponible",
                        fillColor: "#85C1F5",
                        strokeColor: "rgba(151,187,205,0.8)",
                        highlightFill: "#4A789C",
                        highlightStroke: "rgba(151,187,205,1)",
                        data: [data[0][6],data[0][7],data[0][8]]
                    },
                    {
                        label: "Activas",
                        fillColor: "#7FCA9F",
                        strokeColor: "rgba(151,187,205,0.8)",
                        highlightFill: "#3f654f",
                        highlightStroke: "rgba(151,187,205,1)",
                        data: [data[0][0],data[0][1],data[0][2]]
                    }
                ]
            };
            
            var options = {
                scaleBeginAtZero : true,
                scaleShowGridLines : false,
                barShowStroke : true,
                barStrokeWidth : 2,
                barValueSpacing : 5,
                barDatasetSpacing : 1,
                responsive: true,
                scaleFontFamily: 'regular',
                scaleFontSize: 15,
                scaleFontColor: "#FFF",
                maintainAspectRatio:false,
            };
            
            var ctx = document.getElementById("canvas").getContext("2d");
            new Chart(ctx).Bar(datos, options);
        }
    });

    $("#collapseOne").on('shown.bs.collapse', function(){
      $('html, body').animate({
                        scrollTop: $("#simcard-crud-container").offset().top
                        }, 500);
    });
    
    $("#collapseTwo").on('shown.bs.collapse', function(){
        if (firstTime){
            var data = [
                {
                    value: 300,
                    color:"#d3d3d3",
                    highlight: "#d3d3d3"
                },
                {
                    value: 50,
                    color: "#d3d3d3",
                    highlight: "#d3d3d3"
                },
                {
                    value: 100,
                    color: "#d3d3d3",
                    highlight: "#d3d3d3"
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
            
            var ctx = document.getElementById("canvas_estado_subs").getContext("2d");
            var ctxLibres = document.getElementById("canvas_estado_subs_libres").getContext("2d");
            donnutChart = new Chart(ctx).Doughnut(data,options);
            donnutChartLibres = new Chart(ctxLibres).Doughnut(data,options);
            firstTime = false;
        }
        $('html, body').animate({
                    scrollTop: $("#subs-state-container").offset().top
                    }, 500);
    });
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

function buscarSim(){
    var icc = document.getElementById("ICC").value;
    var telefono = document.getElementById("telefono").value;
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/buscar',
        data:{icc:icc, telefono:telefono},
        type:'GET',
        dataType: 'json',
        success: function(data){
            if(data != ''){
                var today = new Date();
                $('#ICC').val(data[0].ICC);
                $('#telefono').val(data[0].numero);
                $('#ICC-resultado').val(data[0].ICC);
                $('#telefono-resultado').val(data[0].numero);
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
    $('#subdistribuidor-resultado').html('SELECCIONA');
    $('#fecha_vencimiento-resultado').val('');
    $('#fecha_activacion-resultado').val('');
    $('#ICC').val('');
    $('#telefono').val('');
    changeClass("gray"); 
}

function eliminar_simcard(){
    var icc = $('#ICC-resultado').val();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/eliminar',
        data:{icc:icc},
        type:'GET',
        dataType: 'json',
        success: function(data){
            if(data == -2){
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('No puedes eliminar una simcard que no te pertenezca');
                $('#modal-content').modal('show');
            }else if(data == -1){
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Debes ingresar un ICC');
                $('#modal-content').modal('show');
            }else{
                $('.modal-header #modal-tittle').html('Exito');
                $('.modal-body #modal-body').html('Simcard eliminada satisfactoriamente');
                $('#ICC-resultado').val('');
                $('#telefono-resultado').val('');
                $('#paquete-resultado').val('');
                $('#tipo-resultado').val('');
                $('#distribuidor-resultado').val('');
                $('#subdistribuidor-resultado').val('SELECCIONA');
                $('#fecha_vencimiento-resultado').val('');
                $('#fecha_activacion-resultado').val('');
            }
            $('#modal-loading').modal('hide');
        }
    });
}

function actualizar_simcard(){
    var icc = document.getElementById("ICC").value;
    var iccNuevo = $('#ICC-resultado').val();
    var telefono = $('#telefono-resultado').val();
    var paquete = $('#paquete-resultado').val();
    var tipo = $('#tipo-resultado').val();
    var fecha_vencimiento = $('#fecha_vencimiento-resultado').val();
    var fecha_activacion = $('#fecha_activacion-resultado').val();
    var subdistribuidor = $('#subdistribuidor-resultado').html();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'simcard/actualizar',
        data:{icc:icc, iccNuevo:iccNuevo, telefono:telefono, paquete:paquete, tipo:tipo, subdistribuidor:subdistribuidor, fecha_vencimiento:fecha_vencimiento,fecha_activacion:fecha_activacion},
        type:'GET',
        dataType: 'json',
        success: function(data){
            if(data == -3){
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('La ICC ya existe');
                $('#modal-content').modal('show');
            }else if(data == -2){
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('No puedes editar una simcard que no te pertenezca');
                $('#modal-content').modal('show');
            }else if(data == -1){
                $('.modal-header #modal-tittle').html('Error');
                $('.modal-body #modal-body').html('Debes ingresar un ICC');
                $('#modal-content').modal('show');
            }else{
                $('.modal-header #modal-tittle').html('Exito');
                $('.modal-body #modal-body').html('Simcard actualizada satisfactoriamente');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
        }
    });
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
