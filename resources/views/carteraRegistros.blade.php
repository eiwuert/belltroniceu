@foreach($registros as $registro)
<div class="registro" id ="{{$registro['id']}}">
    @if($registro['total'] < 0)
    <div class="container_fecha red_soft"><input type="text" id="{{$registro['id']}}_fecha" class="center_vert" value="{{$registro['fecha']}}" style="max-width:100px"></input></div>
    <div class="container_descripcion red_soft"><input type="text" id="{{$registro['id']}}_descripcion" class="center_vert" value="{{$registro['descripcion']}}" style="max-width:500px;width:500px"></input></div>
    @if($user->isAdmin)
    <div class="container_cantidad_admin red_soft"><input type="text" id="{{$registro['id']}}_cantidad" class="center_vert" value="{{$registro['cantidad']}}" style="max-width:500px;width:50px"></input></div>
    <div class="container_valor_admin red_soft"><input type="text" id="{{$registro['id']}}_valor" class="center_vert" value="${{number_format($registro['valor_unitario']*-1,0,".",",")}}" style="max-width:500px;width:150px"></input></div>
    @else
    <div class="container_cantidad red_soft"><input type="text" id="{{$registro['id']}}_cantidad" class="center_vert" value="{{$registro['cantidad']}}" style="max-width:500px;width:50px"></input></div>
    <div class="container_valor red_soft"><input type="text" id="{{$registro['id']}}_valor" class="center_vert" value="${{number_format($registro['valor_unitario']*-1,0,".",",")}}" style="max-width:500px;width:150px"></input></div>
    @endif
    <div class="container_total red_soft"><input type="text" disabled="true" id="{{$registro['id']}}_total" class="center_vert" value="${{number_format($registro['total']*-1,0,".",",")}}" style="max-width:500px;width:150px"></input></div>
    @else
    <div class="container_fecha green_soft"><input type="text" id="{{$registro['id']}}_fecha" class="center_vert" value="{{$registro['fecha']}}" style="max-width:100px"></input></div>
    <div class="container_descripcion green_soft"><input type="text" id="{{$registro['id']}}_descripcion" class="center_vert" value="{{$registro['descripcion']}}" style="max-width:500px;width:500px"></input></div>
    @if($user->isAdmin)
    <div class="container_cantidad_admin green_soft"><input type="text" id="{{$registro['id']}}_cantidad" class="center_vert" value="{{$registro['cantidad']}}" style="max-width:500px;width:50px"></input></div>
    <div class="container_valor_admin green_soft"><input type="text" id="{{$registro['id']}}_valor" class="center_vert" value="${{number_format($registro['valor_unitario'],0,".",",")}}" style="max-width:500px;width:150px"></input></div>
    @else
    <div class="container_cantidad green_soft"><input type="text" id="{{$registro['id']}}_cantidad" class="center_vert" value="{{$registro['cantidad']}}" style="max-width:500px;width:50px"></input></div>
    <div class="container_valor green_soft"><input type="text" id="{{$registro['id']}}_valor" class="center_vert" value="${{number_format($registro['valor_unitario'],0,".",",")}}" style="max-width:500px;width:150px"></input></div>
    @endif
    <div class="container_total green_soft"><input type="text" disabled ="true" id="{{$registro['id']}}_total" class="center_vert" value="${{number_format($registro['total'],0,".",",")}}" style="max-width:500px;width:150px"></input></div>
    @endif
    <div class="container_total green_soft" style="max-width:500px;width:50px;"><a class="center_vert_icons" href="javascript:void(0);" onclick="actualizar_registro(this)"><i class="fa fa-check fa-2x"></i></a></div>
    <div class="container_total red_soft" style="max-width:500px;width:50px;"><a class="center_vert_icons" href="javascript:void(0);" onclick="borrar_registro(this)"><i class="fa fa-times fa-2x"></i></a></div>
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