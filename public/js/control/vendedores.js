function showPosition(position) {
    var cedula = $('#cedula').val();
    $.ajax({
        url:'control/registroVendedor',
        data:{latitud:position.coords.latitude,longitud:position.coords.longitude,cedula:cedula},
        type:'get',
        success: function(data){
            alert('satisfactorio');
        }
     }); 
}
function mandar_ubicacion(){
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function buscar(){
    var cedula = $('[data-id="subPicker_cedula"]').text();
    $.ajax({
        url:'control/buscar',
        data:{cedula:cedula},
        type:'get',
        success: function(data){
            var html = "";
            for(var i = 0; i < data.length; i++){
                html += '<label class ="data" style="width:200px;margin-right:20px;">' + data[i].created_at + "</label>" + 
                        '<label class ="data" style="width:200px;margin-right:20px;">' + data[i].latitud + "</label>" +  
                        '<label class ="data" style="width:200px;margin-right:20px;">' + data[i].longitud + "</label><hr>";
            }
            $('#resultado_coordenadas').html(html);
        }
    });
}