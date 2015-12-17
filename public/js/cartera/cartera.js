$( document ).ready(function() {
   $('html, body').animate({
                    scrollTop: $("#total").offset().top
                    }, 500);
});


function ver_cartera(){
    var distribuidor = $('[data-id="subPicker_distri"]').text();
    $('#modal-loading').modal({
        backdrop: 'static',
        keyboard: false
        })
    $.ajax({
        url:'cartera/datos',
        data:{distribuidor:distribuidor},
        type:'GET',
        success: function(data){
            $('#modal-loading').modal("hide");
            $('#registros_container').html(data);
            $('html, body').animate({
                    scrollTop: $("#total").offset().top
                    }, 500);
        }
    });
}