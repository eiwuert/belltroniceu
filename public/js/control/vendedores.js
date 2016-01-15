function showPosition(position) {
    var cedula = $('#cedula').val();
    $.ajax({
        url:'control/registroVendedor',
        data:{latitud:position.coords.latitude,longitud:position.coords.longitude,cedula:cedula},
        type:'get',
        success: function(data){
            if(data == 1){
                alert('satisfactorio');
                $('#cedula').val("");
            }else{
                alert('Error: cedula no registrada en el sistema');
            }
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
    var nombre = $('[data-id="subPicker_cedula"]').text();
    $.ajax({
        url:'control/buscar',
        data:{nombre:nombre},
        type:'get',
        success: function(data){
            var html = "";
            for(var i = 0; i < data.length; i++){
                html += '<button class ="button_simcards green" onClick="ver_mapa(this.value)" style="width:200px;margin-right:20px;color:black;font-size:15px" value="'+data[i].latitud+","+data[i].longitud+'">' + data[i].fecha + "</button>";
            }
            $('#resultado_coordenadas').html(html);
        }
    });
}

function eliminar(){
    var nombre = $('[data-id="subPicker_cedula"]').text();
    if(confirm("Esta seguro?")){
        $.ajax({
            url:'control/eliminar',
            data:{nombre:nombre},
            type:'get',
            success: function(data){
                if(data == 1){
                    $('.modal-header #modal-tittle').html('EXITO');
                    $('.modal-body #modal-body').html("Empleado borrado satisfactoriamente.");
                }else{
                    $('.modal-header #modal-tittle').html('ERROR');
                    $('.modal-body #modal-body').html(data);
                }
                $('#modal-content').modal('show');
            }
        });
    }
}

function ver_mapa(value){
    
    var html = '<iframe frameborder="0" class ="mapa" style="border:0;margin:0 auto;" src="https://www.google.com/maps/embed/v1/place?q='+value+'&key=AIzaSyDaFmSLTqXnu89e_vBGK9gYF70YW-I1KAM" allowfullscreen></iframe>';
    $('.modal-header #modal-tittle').html('UBICACIÓN');
    $('.modal-body #modal-body').html(html);
    $('#modal-content').modal('show');
    
}