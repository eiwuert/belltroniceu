$.ajax({
    url:'diagrama/comisiones',
    type:'GET',
    success: function(data){
        var datos = [];
        var html = "";
        var colors = ['#BDAEC6', '#C1DAD6', '#89E894', '#FFFF66', '#E86850', '#A0596B', 'brown'];
        for (var i = 0; i < data.length; i++){
            html += '<div class="historial_container" style="background: ' + colors[i] + '">' + '<label>'  + data[i].nombre + ':  $' + addCommas(data[i].valor) + '</label></div><hr>';
            datos.push(
                {
                    value: data[i].valor,
                    color:colors[i],
                    highlight: colors[i],
                    label: data[i].nombre
                }
            );    
        }
        
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
        var ctx = document.getElementById("canvasHistorial").getContext("2d");
        new Chart(ctx).Doughnut(datos, options);  
    }
});

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