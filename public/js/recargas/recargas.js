var datosDiagrama=[
            {
                value: 1,
                color:"gray",
                highlight: "gray",
            }
        ];
var datosDiagramaGris=[
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
    tooltipTemplate: "<%if (label){%><%=label%>: <%}%>$<%= addCommas(value) %>",
    multiTooltipTemplate: "$<%= addCommas(value) %>",
}
var ctx = document.getElementById("canvasHistorial").getContext("2d");
var diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagrama, options);  
// MORADO - AZUL - VERDE - AMARILLO - ROJO - NARANJA - ROSADO - AGUAMARINA - VERDE SUAVE - MAGENTA - CAFE - AMARRILLO - MORADO -AZUL - VERDE - ROJO
var colors = ['#BDAEC6', '#C1DAD6', '#89E894', '#FFFF66', '#E86850', '#ffb366', '#ff9999', '#66d9ff', '#99ff66', '#F49AC2', '#836953', '#FDFD96', '#B19CD9', '#C1DAD6', '#89E894', '#E86850'];

$(window).load(function(){
        if($('#modal_upload_result') != null){
            $('#modal_upload_result').modal('show');
        }
    });
function load(){
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $('#modal_upload').modal('hide');
}
function consultar_recargas(distribuidor, periodo){
    var distribuidor = $('[data-id="subPicker_distri"]').text();
    var fecha = $('[data-id="subPicker_fecha"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'diagrama/recargas',
        data:{distribuidor:distribuidor, fecha:fecha},
        type:'GET',
        success: function(data){
            var datos = new Map();
            var datosDiagrama = [];
            var totalPrepago = 0;
            var totalLibre = 0;
            var html = "";
            var aux;
            if(data.length == 0){
                $('#valores_subs').html('<label style="color:red;font-size:18px">No tienes recargas registradas</label>');
                $('#modal-loading').modal('hide');
                diagramaPrepVsLibre.destroy();
                ctx = document.getElementById("canvasHistorial").getContext("2d");
                diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagramaGris, options);  
                return;
            }
            for (var i = 0; i < data.length; i++){
                if(!datos.has(data[i].nombre)){
                    aux = [0,0];
                }else{
                    aux = datos.get(data[i].nombre);
                }
                if(data[i].tipo == 1){
                    aux[0] = Math.floor(data[i].valor);
                }else{
                    aux[1] = Math.ceil(data[i].valor);
                }
                datos.set(data[i].nombre,aux);
            }
            var i = 0;
            datos.forEach(function(values, key) {
                html += '<div class="historial_container" style="background: ' + colors[i] + '">' + '<label style="min-width:200px">'  + key + '</label><label class="historial_label" style="margin-right:10px;">$' + addCommas(values[0]) + '</label><label class="historial_label"> $' + addCommas(values[1]) + '</label></div><br>';
                totalPrepago += values[0];
                totalLibre += values[1];
                i++;
            }, datos)
            
            html += '<h3 class="section-heading text-muted" style="color:black;margin-bottom:20px">TOTAL RECARGADO</h3><hr><label class="historial_label_total">$' + addCommas(totalPrepago+totalLibre) + '</label>';
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
            $('#valores_subs').html(html);
            diagramaPrepVsLibre.destroy();
            ctx = document.getElementById("canvasHistorial").getContext("2d");
            diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagrama, options);
            $('#modal-loading').modal('hide');
        }
    });  
}

function consultar_recargas_no_admin(distribuidor, periodo){
    var fecha = $('[data-id="subPicker_fecha"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'diagrama/recargas',
        data:{distribuidor:null, fecha:fecha},
        type:'GET',
        success: function(data){
            var datos = new Map();
            var datosDiagrama = [];
            var totalPrepago = 0;
            var totalLibre = 0;
            var html = "";
            var aux;
            if(data.length == 0){
                $('#valores_subs').html('<label style="color:red;font-size:18px">No tienes recargas registradas</label>');
                $('#modal-loading').modal('hide');
                diagramaPrepVsLibre.destroy();
                ctx = document.getElementById("canvasHistorial").getContext("2d");
                diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagramaGris, options);  
                return;
            }
            for (var i = 0; i < data.length; i++){
                if(!datos.has(data[i].nombre)){
                    aux = [0,0];
                }else{
                    aux = datos.get(data[i].nombre);
                }
                if(data[i].tipo == 1){
                    aux[0] = Math.floor(data[i].valor);
                }else{
                    aux[1] = Math.ceil(data[i].valor);
                }
                datos.set(data[i].nombre,aux);
            }
            var i = 0;
            datos.forEach(function(values, key) {
                html += '<div class="historial_container" style="background: ' + colors[i] + '">' + '<label style="min-width:200px">'  + key + '</label><label class="historial_label" style="margin-right:10px;">$' + addCommas(values[0]) + '</label><label class="historial_label"> $' + addCommas(values[1]) + '</label></div><br>';
                totalPrepago += values[0];
                totalLibre += values[1];
                i++;
            }, datos)
            
            html += '<h3 class="section-heading text-muted" style="color:black;margin-bottom:20px">TOTAL RECARGADO</h3><hr><label class="historial_label_total">$' + addCommas(totalPrepago+totalLibre) + '</label>';
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
            $('#valores_subs').html(html);
            diagramaPrepVsLibre.destroy();
            ctx = document.getElementById("canvasHistorial").getContext("2d");
            diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagrama, options);
            $('#modal-loading').modal('hide');
        }
    });  
}

function addCommas(nStr)
{
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


function consultar_simcards(){
    var fecha = $('[data-id="subPicker_fecha_estado"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'recargas/simcards',
        data:{distribuidor:null,fecha:fecha},
        type:'GET',
        success: function(data){
            if(data == -1){
                var html = '<label style="color:red"> NO SE ENCONTRARON RECARGAS </label>';
                    $('#msg_recargas_sim').html(html);
            }else{
                try{
                    var html = '<label style="min-width:200px;color:white">TOTAL LINEAS : </label><label style="min-width:100px;color:white">' + data[0] + '</label><hr style="border-top-color:white">';
                    html += '<label style="min-width:200px;color:white"> Lineas sin recarga:  </label><label style="min-width:100px;color:white">' + data[1] + '</label></br>';
                    html += '<label style="min-width:200px;color:white"> Lineas con menos de 3000:  </label><label style="min-width:100px;color:white">' + data[2] + '</label></br>';
                    html += '<label style="min-width:200px;color:white"> Lineas con 3000 o más: </label><label style="min-width:100px;color:white">' + data[3] + '</label>';
                    $('#msg_recargas_sim').html(html);
                    document.getElementById('my_iframe').src = "temp/estadoSimcards.csv";    
                }catch(e){
                    alert(e);
                }
            }
            $('#modal-loading').modal('hide');
        }
    });
}

function descargar_recargas_admin(){
    var fecha = $('[data-id="subPicker_fecha"]').text();
    var distribuidor = $('[data-id="subPicker_distri"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'recargas/descargar_estado',
        data:{distribuidor:distribuidor, fecha:fecha},
        type:'GET',
        success: function(data){
           if(data == -1){
                var html = '<label style="color:red"> NO SE ENCONTRARON RECARGAS </label>';
                    $('#valores_subs').html(html);
            }else{
                try{
                    document.getElementById('my_iframe').src = "temp/estadoRecargas.csv";    
                }catch(e){
                    alert(e);
                }
            }
            $('#modal-loading').modal('hide');
        }
    });
}

function consultar_simcards_distribuidor(){
    var fecha = $('[data-id="subPicker_fecha_distri"]').text();
    var distribuidor = $('[data-id="subPicker_estado_distri"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'recargas/simcards',
        data:{distribuidor:distribuidor, fecha:fecha},
        type:'GET',
        success: function(data){
           if(data == -1){
                var html = '<label style="color:red"> NO SE ENCONTRARON RECARGAS </label>';
                    $('#msg_recargas_sim').html(html);
            }else{
                try{
                    var html = '<label style="min-width:200px;color:white">TOTAL LINEAS : </label><label style="min-width:100px;color:white">' + data[0] + '</label><hr style="border-top-color:white">';
                    html += '<label style="min-width:200px;color:white"> Lineas sin recarga:  </label><label style="min-width:100px;color:white">' + data[1] + '</label></br>';
                    html += '<label style="min-width:200px;color:white"> Lineas con menos de 3000:  </label><label style="min-width:100px;color:white">' + data[2] + '</label></br>';
                    html += '<label style="min-width:200px;color:white"> Lineas con 3000 o más: </label><label style="min-width:100px;color:white">' + data[3] + '</label>';
                    $('#msg_recargas_sim').html(html);
                    document.getElementById('my_iframe').src = "temp/estadoSimcards.csv";    
                }catch(e){
                    alert(e);
                }
            }
            $('#modal-loading').modal('hide');
        }
    });
}

function consultar_simcards_distribuidor_no_admin(){
    var fecha = $('[data-id="subPicker_fecha_distri_noadmin"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'recargas/simcards',
        data:{distribuidor:'user', fecha:fecha},
        type:'GET',
        success: function(data){
           if(data == -1){
                var html = '<label style="color:red"> NO SE ENCONTRARON RECARGAS </label>';
                    $('#msg_recargas_sim').html(html);
            }else{
                try{
                    var html = '<label style="min-width:200px">TOTAL LINEAS : </label><label style="min-width:100px">' + data[0] + '</label><hr>';
                    html += '<label style="min-width:200px"> Lineas sin recarga:  </label><label style="min-width:100px">' + data[1] + '</label></br>';
                    html += '<label style="min-width:200px"> Lineas con menos de 3000:  </label><label style="min-width:100px">' + data[2] + '</label></br>';
                    html += '<label style="min-width:200px"> Lineas con 3000 o más: </label><label style="min-width:100px">' + data[3] + '</label>';
                    $('#msg_recargas_sim').html(html);
                    document.getElementById('my_iframe').src = "temp/estadoSimcards.csv";    
                }catch(e){
                    alert(e);
                }
            }
            $('#modal-loading').modal('hide');
        }
    });
}

function calcular_proyecciones_no_admin(){
    var fecha = $('[data-id="subPicker_fecha_proyeccion"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'recargas/proyecciones',
        data:{fecha:fecha,distribuidor:'USUARIONOADMINISTRADOR'},
        type:'GET',
        success: function(data){
           if(data == -1){
                var html = '<hr><label style="color:red"> NO SE ENCONTRARON RECARGAS </label>';
                    $('#proyecciones_container').html(html);
            }else{
                try{
                    var html = '<hr style="margin: 20px 10%"><label class="red_text" style="min-width:100px;width:100px;font-size:20px;font-weight: 700;margin-right:40px">PREPAGO</label><label class="red_text" style="min-width:100px;width:100px;font-size:20px;font-weight: 700">LIBRE</label>';
                    
                    html += '</br><label style="min-width:200px" class="red_text">ULTIMA RECARGA</label>';
                    html += '</br><label style="min-width:200px;color:black">'+data[6].date+'</label>';
                    
                    html += '</br><label style="min-width:200px" class="red_text">TOTAL RECARGAS:</label>';
                    html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$' +addCommas(Math.floor(data[0])) +'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[1])) + '</label>';
                    
                    html += '</br><label style="min-width:200px"  class="red_text">RECARGA DIARIA</label>';
                    html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$'+addCommas(Math.floor(data[2]))+'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[3])) + '</label>';
                    
                    html += '</br><label style="min-width:200px"  class="red_text">PROYECCION DE RECARGAS</label>';
                    html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$'+addCommas(Math.floor(data[4]))+'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[5])) + '</label>';
                    
                    html += '</br><label style="min-width:200px"  class="red_text">PROYECCION DE GANANCIAS</label>';
                    html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$'+addCommas(Math.floor(data[4]*0.19))+'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[5]*0.12)) + '</label>';
                    
                    
                    $('#proyecciones_container').html(html);
                }catch(e){
                    alert(e);
                }
            }
            $('#modal-loading').modal('hide');
        }
    });
}
function calcular_proyecciones(){
    var distribuidor = $('[data-id="subPicker_distri_proyeccion"]').text();
    var fecha = $('[data-id="subPicker_fecha_proyeccion"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'recargas/proyecciones',
        data:{fecha:fecha,distribuidor:distribuidor},
        type:'GET',
        success: function(data){
           if(data == -1){
                var html = '<hr><label style="color:red"> NO SE ENCONTRARON RECARGAS </label>';
                    $('#proyecciones_container').html(html);
            }else{
                try{
                    var html = '<hr style="margin: 20px 10%"><label class="red_text" style="min-width:100px;width:100px;font-size:20px;font-weight: 700;margin-right:40px">PREPAGO</label><label class="red_text" style="min-width:100px;width:100px;font-size:20px;font-weight: 700">LIBRE</label>';
                    
                    html += '</br><label style="min-width:200px" class="red_text">ULTIMA RECARGA:</label>';
                    html += '</br><label style="min-width:200px;color:black">'+data[6].date+'</label>';
                    
                    html += '</br><label style="min-width:200px" class="red_text">TOTAL RECARGAS:</label>';
                    html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$' +addCommas(Math.floor(data[0])) +'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[1])) + '</label>';
                    
                    html += '</br><label style="min-width:200px"  class="red_text">RECARGA DIARIA</label>';
                    html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$'+addCommas(Math.floor(data[2]))+'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[3])) + '</label>';
                    
                    html += '</br><label style="min-width:200px"  class="red_text">PROYECCION DE RECARGAS</label>';
                    html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$'+addCommas(Math.floor(data[4]))+'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[5])) + '</label>';
                    
                    html += '</br><label style="min-width:200px"  class="red_text">PROYECCION DE GANANCIAS OFICINA</label>';
                    
                    html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$'+addCommas(Math.floor(data[4]*0.25))+'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[5]*0.19)) + '</label>';
                    if(data[7] == false){
                        html += '</br><label style="min-width:200px"  class="red_text">PROYECCION DE GANANCIAS DISTRIBUIDOR</label>';
                        html += '</br><label style="min-width:100px;width:100px;margin-right:40px">$'+addCommas(Math.floor(data[4]*0.17))+'</label><label style="min-width:100px;width:100px">$' + addCommas(Math.floor(data[5]*0.12)) + '</label>';
                    }
                    $('#proyecciones_container').html(html);
                }catch(e){
                    alert(e);
                }
            }
            $('#modal-loading').modal('hide');
        }
    });
}

function borrar_recargas(){
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'recargas/borrar',
        type:'GET',
        success: function(data){
            if(data == 1){
                $('.modal-header #modal-tittle').html('Exito');
                $('.modal-body #modal-body').html('Recargas borradas.');
                $('#modal-content').modal('show');
            }
            $('#modal-loading').modal('hide');
        }
    });
    
}
function addCommas(nStr)
{
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}