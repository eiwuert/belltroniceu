$.ajax({
    url:'diagrama/simcards',
    type:'GET',
    success: function(data){
        var datosPrepago = {
            labels: [data[1][0], data[1][1], data[1][2]],
            datasets: [
                {
                    label: "Vencidas",
                    fillColor: "#DB5466",
                    highlightFill: "#7f3236",
                    data: [data[0][3],data[0][4],data[0][5]]
                },
                {
                    label: "Activas",
                    fillColor: "#7FCA9F",
                    highlightFill: "#3f654f",
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
            scaleFontColor: "#000",
            maintainAspectRatio:false,
        };
        
        var elem = document.getElementById('loader_libre');
        elem.parentNode.removeChild(elem);      
        var elem = document.getElementById('loader_prepago');
        elem.parentNode.removeChild(elem); 
        var ctx = document.getElementById("canvasPrepago").getContext("2d");
        new Chart(ctx).Bar(datosPrepago, options);  
    }
});