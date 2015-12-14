function consultar_subdistribuidor(){
    var nombre = $('[data-id="subPicker_subdistri"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
    })
    $.ajax({
        url:'finanzas/datos_subdistribuidor',
        data:{nombre:nombre},
        type:'GET',
        dataType: 'json',
        success: function(data){
            
            $('#modal-loading').modal("hide");
        }
    });
}
