
@for ($i = 0; $i < count($simcards); $i++)
    @if($simcards[$i]->fecha_activacion != null)
        @if($simcards[$i]->month <= 0)
        <button class="button_simcards green" style="flex-grow:2;width:auto;color:#000;font-weight:normal;font-size:1em" onClick="seleccionarSim(this)" value ="{{$simcards[$i]->numero}}">{{$simcards[$i]->numero}}</button>
        @else
        <button class="button_simcards red" style="flex-grow:2;width:auto;color:#000;font-weight:normal;font-size:1em" onClick="seleccionarSim(this)" value ="{{$simcards[$i]->numero}}">{{$simcards[$i]->numero}}</button>
        @endif
    @else
        @if($simcards[$i]->month <= 0)
        <button class="button_simcards blue" style="flex-grow:2;width:auto;color:#000;font-weight:normal;font-size:1em" onClick="seleccionarSim(this)" value ="{{$simcards[$i]->numero}}">{{$simcards[$i]->numero}}</button>
        @else
        <button class="button_simcards red" style="flex-grow:2;width:auto;color:#000;font-weight:normal;font-size:1em" onClick="seleccionarSim(this)" value ="{{$simcards[$i]->numero}}">{{$simcards[$i]->numero}}</button>
        @endif
    @endif
@endfor