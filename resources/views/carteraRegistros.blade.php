@foreach($registros as $registro)
<div class="registro">
    @if($registro['total'] < 0)
    <div class="container_fecha red_soft"><label class="center_vert">{{$registro['fecha']}}</label></div>
    <div class="container_descripcion red_soft"><label class="center_vert">{{$registro['descripcion']}}</label></div>
    <div class="container_cantidad red_soft"><label class="center_vert">{{$registro['cantidad']}}</label></div>
    <div class="container_valor red_soft"><label class="center_vert">${{number_format($registro['valor_unitario']*-1,0,".",",")}}</label></div>
    <div class="container_total red_soft"><label class="center_vert">${{number_format($registro['total']*-1,0,".",",")}}</label></div>
    @else
    <div class="container_fecha green_soft"><label class="center_vert">{{$registro['fecha']}}</label></div>
    <div class="container_descripcion green_soft"><label class="center_vert">{{$registro['descripcion']}}</label></div>
    <div class="container_cantidad green_soft"><label class="center_vert">{{$registro['cantidad']}}</label></div>
    <div class="container_valor green_soft"><label class="center_vert">${{number_format($registro['valor_unitario'],0,".",",")}}</label></div>
    <div class="container_total green_soft"><label class="center_vert">${{number_format($registro['total'],0,".",",")}}</label></div>
    @endif
</div>
@endforeach
<hr>
<div class="registro" id ="total">
    @if($total < 0)
    <div class="container_descripcion red_soft"><label class="center_vert">TOTAL</label></div>
    <div class="container_total red_soft"><label class="center_vert">${{number_format($total*-1,0,".",",")}}</label></div>
    @else
    <div class="container_descripcion green_soft"><label class="center_vert">TOTAL</label></div>
    <div class="container_total green_soft"><label class ="center_vert">${{number_format($total,0,".",",")}}</label></div>
    @endif
</div>