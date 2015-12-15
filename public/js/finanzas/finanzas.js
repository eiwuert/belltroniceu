var chart;
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
            }
            var ctx = document.getElementById("canvasPrepago").getContext("2d");
            chart = new Chart(ctx).Doughnut(data, {
                animateScale: true
            });
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
            $('#total_dis').val("Distribuidor:  $" + addCommas(data[0]+data[1]));
            $('#total_sub').val("Subdistribuidor:  $" + addCommas(data[1]));
            var data = [
                {
                    value: data[0],
                    color:"#d3d3d3",
                    highlight: "#c3c3c3",
                    label: "Total"
                },
                {
                    value: data[1],
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
            var ctx = document.getElementById("canvasPrepago").getContext("2d");
            chart.destroy();
            chart = new Chart(ctx).Doughnut(data, options);
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