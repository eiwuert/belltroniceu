$(document).ready(function(){
    var data = [
                {
                    value: 100,
                    color:"#ff656c",
                    highlight: "#7f3236",
                    label: "Vencidas",
                },
                {
                    value: 300,
                    color: "#85C1F5",
                    highlight: "#4A789C",
                    label: "Disponibles"
                },
                {
                    value: 200,
                    color: "#7FCA9F",
                    highlight: "#3f654f",
                    label: "Activas"
                }
                ];
    
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
    
    var data2 = {
    labels: ["Octubre", "Septiembre", "Noviembre"],
    datasets: [
        {
            label: "Vencidas",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80]
        },
        {
            label: "Disponibles",
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40]
        },
        {
            label: "Activas",
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40]
        }
    ]
};
    var ctx = document.getElementById("canvas1").getContext("2d");
    new Chart(ctx).Bar(data2, options);
    var ctx = document.getElementById("canvas2").getContext("2d");
    new Chart(ctx).Bar(data2, options);
});