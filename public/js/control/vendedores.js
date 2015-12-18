
function mandar_ubicacion(){
    var cedula = $('#cedula').val();
    $.ajax({
        url:'https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDaFmSLTqXnu89e_vBGK9gYF70YW-I1KAM',
        type:'POST',
        success: function(data){
            var latitud = data['location'].lat;
            var longitud = data['location'].lng;
            var cedula = $('#cedula').val();
             $.ajax({
                url:'control/registroVendedor',
                data:{latitud:latitud,longitud:longitud,cedula:cedula},
                type:'get',
                success: function(data){
                    alert('satisfactorio');
                }
             });
        }
        
    });
}