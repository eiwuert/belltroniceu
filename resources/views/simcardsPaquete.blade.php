
@for ($i = 0; $i < count($simcards); $i++)
    <button class="button_simcards {{$colors[$i]}}" style="flex-grow:2;width:auto;color:#000;font-weight:normal;font-size:1em" onClick="seleccionarSim(this)" value ="{{$simcards[$i]->numero}}">{{$simcards[$i]->numero}}</button>
@endfor