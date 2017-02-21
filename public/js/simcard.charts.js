$.ajax({
    url:'diagrama/simcards',
    type:'GET',
    success: function(data){
        var datosPrepago = {
            labels: [data[1][0], data[1][1], data[1][2],data[1][3],data[1][4]],
            datasets: [
                {
                    label: "Vencidas",
                    fillColor: "rgba(219, 84, 102,.5)",
                    strokeColor: "rgba(219, 84, 102,1)",
                    pointColor: "rgba(219, 84, 102,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(219, 84, 102,1)",
                    data: [data[0][5],data[0][6],data[0][7],data[0][8],data[0][9]]
                },
                {
                    label: "Recargadas",
                    fillColor: "rgba(127, 202, 159,.5)",
                    strokeColor: "rgba(127, 202, 159,1)",
                    pointColor: "rgba(127, 202, 159,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(127, 202, 159,1)",
                    data: [data[0][0],data[0][1],data[0][2],data[0][3],data[0][4]]
                }
            ]
        };
        var options = {
            scaleShowGridLines : false,
            scaleShowHorizontalLines: false,
            scaleShowVerticalLines: false,
            bezierCurve : true,
            bezierCurveTension : 0.4,
            pointDot : true,
            pointDotRadius : 4,
            pointDotStrokeWidth : 1,
            pointHitDetectionRadius : 20,
            datasetStroke : true,
            datasetStrokeWidth : 2,
            datasetFill : true,
            responsive:true,
            maintainAspectRatio:false,
            multiTooltipTemplate: "<%= datasetLabel %>: <%= value %>",
        };
        
        var elem = document.getElementById('loader_prepago');
        elem.parentNode.removeChild(elem); 
        var ctx = document.getElementById("canvasPrepago").getContext("2d");
        new Chart(ctx).Line(datosPrepago, options);  
    }
});