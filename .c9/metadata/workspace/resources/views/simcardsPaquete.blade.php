{"filter":false,"title":"simcardsPaquete.blade.php","tooltip":"/resources/views/simcardsPaquete.blade.php","undoManager":{"mark":6,"position":6,"stack":[[{"start":{"row":0,"column":0},"end":{"row":2,"column":12},"action":"insert","lines":["+@foreach($simcards as $simcard)","+    <button class=\"button-simcards button-default\" style=\"flex-grow:2;width:auto\" onClick=\"seleccionarSim(this)\" value =\"{{$simcard->numero}}\">{{$simcard->numero}}</button>","+@endforeach"],"id":1}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"remove","lines":["+"],"id":2}],[{"start":{"row":1,"column":0},"end":{"row":1,"column":1},"action":"remove","lines":["+"],"id":3}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":1},"action":"remove","lines":["+"],"id":4}],[{"start":{"row":0,"column":0},"end":{"row":2,"column":11},"action":"remove","lines":["@foreach($simcards as $simcard)","    <button class=\"button-simcards button-default\" style=\"flex-grow:2;width:auto\" onClick=\"seleccionarSim(this)\" value =\"{{$simcard->numero}}\">{{$simcard->numero}}</button>","@endforeach"],"id":5},{"start":{"row":0,"column":0},"end":{"row":3,"column":7},"action":"insert","lines":["","@for ($i = 0; $i < count($simcards); $i++)","    <button class=\"button-simcards {{$colors[$i]}}\" style=\"flex-grow:2;width:auto;color:#000;font-weight:normal;font-size:1em\" onClick=\"seleccionarSim(this)\" value =\"{{$simcards[$i]->numero}}\">{{$simcards[$i]->numero}}</button>","@endfor"]}],[{"start":{"row":2,"column":25},"end":{"row":2,"column":26},"action":"remove","lines":["-"],"id":6}],[{"start":{"row":2,"column":25},"end":{"row":2,"column":26},"action":"insert","lines":["_"],"id":7}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":1,"column":26},"end":{"row":1,"column":26},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":46,"mode":"ace/mode/php"}},"timestamp":1449798967910,"hash":"f29c4b32d331ca40f687bfa91fa6f8e3ce1285e8"}