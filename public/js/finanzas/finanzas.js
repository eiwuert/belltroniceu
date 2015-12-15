var chart_Prepago,chart_Libre;
$(document).ready(function () {
    var data = [
        {
            value: 1,
            color:"#d3d3d3",
            highlight: "#c3c3c3",
            label: "Total"
        }
    ]
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
    var ctx = document.getElementById("canvasPrepago").getContext("2d");
    chart_Prepago = new Chart(ctx).Doughnut(data, options);
    var ctx = document.getElementById("canvasLibre").getContext("2d");
    chart_Libre = new Chart(ctx).Doughnut(data, options);
});

function consultar_subdistribuidor(){
    var nombre = $('[data-id="subPicker_subdistri"]').text();
    var periodo = $('[data-id="subPicker_periodo"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'finanzas/datos_subdistribuidor',
        data:{nombre:nombre, periodo:periodo},
        type:'GET',
        dataType: 'json',
        success: function(data){
            var total_dis_prepago = data[0];
            var total_sub_prepago = data[2];
            var total_dis_libre = data[1];
            var total_sub_libre = data[3];
            
            $('#total_dis_prepago').val("$" + addCommas(total_dis_prepago));
            $('#total_sub_prepago').val("$" + addCommas(total_sub_prepago));
            $('#total_dis_libre').val("$" + addCommas(total_dis_libre));
            $('#total_sub_libre').val("$" + addCommas(total_sub_libre));
            
            // IMPUESTOS
            
            var total_dis_prepago_at = Math.floor(total_dis_prepago * 0.9486);
            var total_sub_prepago_at = Math.floor(total_sub_prepago * 0.9486);
            var total_dis_libre_at = Math.floor(total_dis_libre * 0.9486);
            var total_sub_libre_at = Math.floor(total_sub_libre * 0.9486);
            
            $('#total_dis_prepago_at').val("$" + addCommas(total_dis_prepago_at));
            $('#total_sub_prepago_at').val("$" + addCommas(total_sub_prepago_at));
            $('#total_dis_libre_at').val("$" + addCommas(total_dis_libre_at));
            $('#total_sub_libre_at').val("$" + addCommas(total_sub_libre_at));
            
            var dataPrepago = [
                {
                    value: total_dis_prepago-total_sub_prepago,
                    color:"#d3d3d3",
                    highlight: "#c3c3c3",
                    label: "Resto"
                },
                {
                    value: total_sub_prepago,
                    color: "#7FCA9F",
                    highlight: "#3f654f",
                    label:  $('[data-id="subPicker_subdistri"]').text(),
                }
            ]
            var dataLibre = [
                {
                    value: total_dis_libre-total_sub_libre,
                    color:"#d3d3d3",
                    highlight: "#c3c3c3",
                    label: "Resto"
                },
                {
                    value: data[3],
                    color: "#7FCA9F",
                    highlight: "#3f654f",
                    label:  $('[data-id="subPicker_subdistri"]').text(),
                }
            ]
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
                tooltipTemplate: "<%if (label){%><%=label%>: <%}%>$<%=addCommas(value) %>",
            }
            chart_Prepago.destroy();
            chart_Libre.destroy();
            
            var ctx = document.getElementById("canvasPrepago").getContext("2d");
            chart_Prepago = new Chart(ctx).Doughnut(dataPrepago, options);
            var ctx = document.getElementById("canvasLibre").getContext("2d");
            chart_Libre = new Chart(ctx).Doughnut(dataLibre, options);
            $('#modal-loading').modal("hide");
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