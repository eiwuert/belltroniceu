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
}
var ctx = document.getElementById("canvasHistorial").getContext("2d");
var diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagrama, options);  
// MORADO - AZUL - VERDE - AMARILLO - ROJO - NARANJA - ROSADO - AGUAMARINA - VERDE SUAVE - MAGENTA - CAFE - AMARRILLO - MORADO -AZUL - VERDE - ROJO
var colors = ['#BDAEC6', '#C1DAD6', '#89E894', '#FFFF66', '#E86850', '#ffb366', '#ff9999', '#66d9ff', '#99ff66', '#F49AC2', '#836953', '#FDFD96', '#B19CD9', '#C1DAD6', '#89E894', '#E86850'];

function consultar_distribuidor_admin(){
    var distribuidor = $('[data-id="subPicker_distri"]').text();
    var periodo = $('[data-id="subPicker_periodo"]').text();
    $.ajax({
        url:'diagrama/comisiones',
        data:{distribuidor:distribuidor, periodo:periodo},
        type:'GET',
        success: function(data){
            var datos = new Map();
            var datosDiagrama = [];
            var totalPrepago = 0;
            var totalLibre = 0;
            var html = "";
            var aux;
            if(data == [] ){
                $('#valores_subs').html("<label>No tienes ganancias registradas</label>");
                return;
            }
            for (var i = 0; i < data.length; i++){
                if(!datos.has(data[i].nombre)){
                    aux = [0,0];
                }else{
                    aux = datos.get(data[i].nombre);
                }
                if(data[i].tipo == 1){
                    aux[0] = Math.floor(data[i].valor*0.5786);
                }else{
                    aux[1] = Math.ceil(data[i].valor*0.4386);
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
            html += '<h3 class="section-heading text-muted" style="color:black;margin-bottom:20px">TOTAL A PAGAR</h3><hr><label class="historial_label_total">$' + addCommas(totalPrepago) + '</label><label class="historial_label_total">$' + addCommas(totalLibre) + '</label>';
            var total=totalPrepago+totalLibre;
            datosDiagrama.push(
                        {
                            value: Math.floor(totalLibre*100/total),
                            color:"#7FCA9F",
                            highlight: "#3f654f",
                            label: "Libre"
                        }
                    );
            datosDiagrama.push(
                        {
                            value: Math.ceil(totalPrepago*100/total),
                            color:"#85C1F5",
                            highlight: "#4A789C",
                            label: "Prepago"
                        }
                    );
                    
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
            }
            $('#valores_subs').html(html);
            diagramaPrepVsLibre.destroy();
            var ctx = document.getElementById("canvasHistorial").getContext("2d");
            diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagrama, options);  
        }
    });  
}
function consultar_distribuidor(){
    var periodo = $('[data-id="subPicker_periodo"]').text();
    $.ajax({
        url:'diagrama/comisiones',
        data:{distribuidor: null, periodo:periodo},
        type:'GET',
        success: function(data){
            var datos = new Map();
            var datosDiagrama = [];
            var totalPrepago = 0;
            var totalLibre = 0;
            var html = "";
            var aux;
            if(data == [] ){
                $('#valores_subs').html("<label>No tienes ganancias registradas</label>");
                return;
            }
            for (var i = 0; i < data.length; i++){
                if(!datos.has(data[i].nombre)){
                    aux = [0,0];
                }else{
                    aux = data.get(data[i].nombre);
                }
                if(data[i].tipo == 1){
                    aux[0] = Math.floor(data[i].valor);
                }else{
                    aux[1] = Math.floor(data[i].valor);
                }
                datos.set(data[i].nombre,aux);
            }
            var i = 0;
            datos.forEach(function(values, key) {
                html += '<div class="historial_container" style="background: ' + colors[i] + '">' + '<label style="min-width:200px">'  + key + '</label><label style="background:rgba(20,20,20,.4);margin:0 10px;min-width:150px">$' + addCommas(values[0]) + '</label><label style="background:rgba(20,20,20,.4);min-width:150px"> $' + addCommas(values[1]) + '</label></div><hr>';
                totalPrepago += values[0];
                totalLibre += values[1];
                i++;
            }, datos)
            html += '<label style="margin:0 10px;min-width:150px;margin-bottom:10px;color:#FFF">$' + addCommas(totalPrepago) + '</label><label style="margin:0 10px;min-width:150px;margin-bottom:10px;color:#FFF">$' + addCommas(totalLibre) + '</label>';
            var total=totalPrepago+totalLibre;
            datosDiagrama.push(
                        {
                            value: Math.floor(totalLibre*100/total),
                            color:"#7FCA9F",
                            highlight: "#3f654f",
                            label: "Libre"
                        }
                    );
            datosDiagrama.push(
                        {
                            value: Math.floor(totalPrepago*100/total),
                            color:"#85C1F5",
                            highlight: "#4A789C",
                            label: "Prepago"
                        }
                    );
                    
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
            }
            $('#valores_subs').html(html);
            diagramaPrepVsLibre.destroy();
            var ctx = document.getElementById("canvasHistorial").getContext("2d");
            diagramaPrepVsLibre = new Chart(ctx).Doughnut(datosDiagrama, options);  
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