@foreach($subdistribuidores as $subdistribuidor)
    <button class="button-simcards button-default" style="flex-grow:2;width:auto" onClick="seleccionar_sub(this)" value ="{{$subdistribuidor->nombre}}">{{$subdistribuidor->nombre}}</button>
@endforeach