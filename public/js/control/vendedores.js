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
                html += '<button class ="button_simcards green" onClick="ver_mapa(this.value)" style="width:200px;margin-right:20px;" value="'+data[i].latitud+","+data[i].longitud+'">' + data[i].created_at + "</button>";
            }
            $('#resultado_coordenadas').html(html);
        }
    });
}

function ver_mapa(value){
    
    var html = '<iframe width="100%" height="300" frameborder="0" style="border:0;margin:0 auto;" src="https://www.google.com/maps/embed/v1/place?q='+value+'&key=AIzaSyDaFmSLTqXnu89e_vBGK9gYF70YW-I1KAM" allowfullscreen></iframe>';
    $('.modal-header #modal-tittle').html('UBICACIÓN');
    $('.modal-body #modal-body').html(html);
    $('#modal-content').modal('show');
    
}