{"filter":false,"title":"ControlController.php","tooltip":"/app/Http/Controllers/ControlController.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":51,"column":25},"end":{"row":51,"column":26},"action":"insert","lines":["e"],"id":821}],[{"start":{"row":51,"column":26},"end":{"row":51,"column":27},"action":"insert","lines":["t"],"id":822}],[{"start":{"row":51,"column":27},"end":{"row":51,"column":28},"action":"insert","lines":["u"],"id":823}],[{"start":{"row":51,"column":28},"end":{"row":51,"column":29},"action":"insert","lines":["r"],"id":824}],[{"start":{"row":51,"column":29},"end":{"row":51,"column":30},"action":"insert","lines":["n"],"id":825}],[{"start":{"row":51,"column":30},"end":{"row":51,"column":31},"action":"insert","lines":[" "],"id":826}],[{"start":{"row":51,"column":31},"end":{"row":51,"column":32},"action":"insert","lines":["-"],"id":827}],[{"start":{"row":51,"column":32},"end":{"row":51,"column":33},"action":"insert","lines":["1"],"id":828}],[{"start":{"row":51,"column":33},"end":{"row":51,"column":34},"action":"insert","lines":[";"],"id":829}],[{"start":{"row":42,"column":0},"end":{"row":42,"column":4},"action":"insert","lines":["    "],"id":830},{"start":{"row":43,"column":0},"end":{"row":43,"column":4},"action":"insert","lines":["    "]},{"start":{"row":44,"column":0},"end":{"row":44,"column":4},"action":"insert","lines":["    "]},{"start":{"row":45,"column":0},"end":{"row":45,"column":4},"action":"insert","lines":["    "]},{"start":{"row":46,"column":0},"end":{"row":46,"column":4},"action":"insert","lines":["    "]},{"start":{"row":47,"column":0},"end":{"row":47,"column":4},"action":"insert","lines":["    "]},{"start":{"row":48,"column":0},"end":{"row":48,"column":4},"action":"insert","lines":["    "]},{"start":{"row":49,"column":0},"end":{"row":49,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":42,"column":29},"end":{"row":42,"column":44},"action":"remove","lines":["Subdistribuidor"],"id":831},{"start":{"row":42,"column":29},"end":{"row":42,"column":30},"action":"insert","lines":["A"]}],[{"start":{"row":42,"column":30},"end":{"row":42,"column":31},"action":"insert","lines":["s"],"id":832}],[{"start":{"row":42,"column":31},"end":{"row":42,"column":32},"action":"insert","lines":["e"],"id":833}],[{"start":{"row":42,"column":32},"end":{"row":42,"column":33},"action":"insert","lines":["s"],"id":834}],[{"start":{"row":42,"column":33},"end":{"row":42,"column":34},"action":"insert","lines":["o"],"id":835}],[{"start":{"row":42,"column":34},"end":{"row":42,"column":35},"action":"insert","lines":["r"],"id":836}],[{"start":{"row":44,"column":28},"end":{"row":44,"column":68},"action":"remove","lines":["'emailDistribuidor' => $email[0]->email,"],"id":837}],[{"start":{"row":44,"column":0},"end":{"row":44,"column":28},"action":"remove","lines":["                            "],"id":838}],[{"start":{"row":43,"column":59},"end":{"row":44,"column":0},"action":"remove","lines":["",""],"id":839}],[{"start":{"row":44,"column":40},"end":{"row":44,"column":45},"action":"remove","lines":["null,"],"id":840},{"start":{"row":44,"column":40},"end":{"row":44,"column":59},"action":"insert","lines":["$request['nombre'],"]}],[{"start":{"row":44,"column":50},"end":{"row":44,"column":56},"action":"remove","lines":["nombre"],"id":841},{"start":{"row":44,"column":50},"end":{"row":44,"column":51},"action":"insert","lines":["c"]}],[{"start":{"row":44,"column":51},"end":{"row":44,"column":52},"action":"insert","lines":["e"],"id":842}],[{"start":{"row":44,"column":52},"end":{"row":44,"column":53},"action":"insert","lines":["d"],"id":843}],[{"start":{"row":44,"column":53},"end":{"row":44,"column":54},"action":"insert","lines":["u"],"id":844}],[{"start":{"row":44,"column":54},"end":{"row":44,"column":55},"action":"insert","lines":["l"],"id":845}],[{"start":{"row":44,"column":55},"end":{"row":44,"column":56},"action":"insert","lines":["a"],"id":846}],[{"start":{"row":45,"column":28},"end":{"row":46,"column":43},"action":"remove","lines":["'telefono' => null,","                            'email' => null"],"id":847}],[{"start":{"row":45,"column":0},"end":{"row":45,"column":28},"action":"remove","lines":["                            "],"id":848}],[{"start":{"row":44,"column":59},"end":{"row":45,"column":0},"action":"remove","lines":["",""],"id":849}],[{"start":{"row":48,"column":32},"end":{"row":48,"column":33},"action":"remove","lines":["1"],"id":850}],[{"start":{"row":48,"column":32},"end":{"row":48,"column":33},"action":"insert","lines":["2"],"id":851}],[{"start":{"row":40,"column":36},"end":{"row":41,"column":0},"action":"insert","lines":["",""],"id":852},{"start":{"row":41,"column":0},"end":{"row":41,"column":20},"action":"insert","lines":["                    "]}],[{"start":{"row":41,"column":20},"end":{"row":41,"column":68},"action":"insert","lines":["$asesor = \\App\\Asesor::find($request['cedula']);"],"id":853}],[{"start":{"row":41,"column":30},"end":{"row":41,"column":68},"action":"remove","lines":["\\App\\Asesor::find($request['cedula']);"],"id":854},{"start":{"row":41,"column":30},"end":{"row":41,"column":112},"action":"insert","lines":["\\DB::select(\"select cedula from asesores where nombre = ?\", [$request['nombre']]);"]}],[{"start":{"row":41,"column":50},"end":{"row":41,"column":56},"action":"remove","lines":["cedula"],"id":855},{"start":{"row":41,"column":50},"end":{"row":41,"column":51},"action":"insert","lines":["a"]}],[{"start":{"row":41,"column":51},"end":{"row":41,"column":52},"action":"insert","lines":["s"],"id":856}],[{"start":{"row":41,"column":52},"end":{"row":41,"column":53},"action":"insert","lines":["e"],"id":857}],[{"start":{"row":41,"column":53},"end":{"row":41,"column":54},"action":"insert","lines":["s"],"id":858}],[{"start":{"row":41,"column":54},"end":{"row":41,"column":55},"action":"insert","lines":["o"],"id":859}],[{"start":{"row":41,"column":55},"end":{"row":41,"column":56},"action":"insert","lines":["r"],"id":860}],[{"start":{"row":42,"column":30},"end":{"row":42,"column":31},"action":"insert","lines":["."],"id":861}],[{"start":{"row":42,"column":31},"end":{"row":42,"column":32},"action":"insert","lines":["l"],"id":862}],[{"start":{"row":42,"column":32},"end":{"row":42,"column":33},"action":"insert","lines":["e"],"id":863}],[{"start":{"row":42,"column":33},"end":{"row":42,"column":34},"action":"insert","lines":["n"],"id":864}],[{"start":{"row":42,"column":34},"end":{"row":42,"column":35},"action":"insert","lines":["g"],"id":865}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["-"],"id":866}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":[">"],"id":867}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["n"],"id":868}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["o"],"id":869}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["m"],"id":870}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["b"],"id":871}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["r"],"id":872}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["e"],"id":873}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":[" "],"id":874}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["!"],"id":875}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["="],"id":876}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":[" "],"id":877}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["$"],"id":878}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["r"],"id":879}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["e"],"id":880}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["q"],"id":881}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["u"],"id":882}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["e"],"id":883}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["s"],"id":884}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["t"],"id":885}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["["],"id":886}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["'"],"id":887}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["n"],"id":888}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["o"],"id":889}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["m"],"id":890}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["b"],"id":891}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["r"],"id":892}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["e"],"id":893}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["'"],"id":894}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["]"],"id":895}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"insert","lines":["t"],"id":896}],[{"start":{"row":42,"column":36},"end":{"row":42,"column":37},"action":"insert","lines":["h"],"id":897}],[{"start":{"row":42,"column":36},"end":{"row":42,"column":37},"action":"remove","lines":["h"],"id":898}],[{"start":{"row":42,"column":35},"end":{"row":42,"column":36},"action":"remove","lines":["t"],"id":899}],[{"start":{"row":42,"column":34},"end":{"row":42,"column":35},"action":"remove","lines":["g"],"id":900}],[{"start":{"row":42,"column":33},"end":{"row":42,"column":34},"action":"remove","lines":["n"],"id":901}],[{"start":{"row":42,"column":32},"end":{"row":42,"column":33},"action":"remove","lines":["e"],"id":902}],[{"start":{"row":42,"column":31},"end":{"row":42,"column":32},"action":"remove","lines":["l"],"id":903}],[{"start":{"row":42,"column":30},"end":{"row":42,"column":31},"action":"remove","lines":["."],"id":904}],[{"start":{"row":42,"column":23},"end":{"row":42,"column":24},"action":"insert","lines":["s"],"id":905}],[{"start":{"row":42,"column":24},"end":{"row":42,"column":25},"action":"insert","lines":["y"],"id":906}],[{"start":{"row":42,"column":25},"end":{"row":42,"column":26},"action":"insert","lines":["s"],"id":907}],[{"start":{"row":42,"column":23},"end":{"row":42,"column":33},"action":"remove","lines":["sys$asesor"],"id":908},{"start":{"row":42,"column":23},"end":{"row":42,"column":30},"action":"insert","lines":["sizeof "]}],[{"start":{"row":42,"column":29},"end":{"row":42,"column":30},"action":"remove","lines":[" "],"id":909}],[{"start":{"row":42,"column":29},"end":{"row":42,"column":31},"action":"insert","lines":["()"],"id":910}],[{"start":{"row":42,"column":30},"end":{"row":42,"column":31},"action":"insert","lines":["$"],"id":911}],[{"start":{"row":42,"column":31},"end":{"row":42,"column":32},"action":"insert","lines":["a"],"id":912}],[{"start":{"row":42,"column":32},"end":{"row":42,"column":33},"action":"insert","lines":["s"],"id":913}],[{"start":{"row":42,"column":33},"end":{"row":42,"column":34},"action":"insert","lines":["e"],"id":914}],[{"start":{"row":42,"column":30},"end":{"row":42,"column":34},"action":"remove","lines":["$ase"],"id":915},{"start":{"row":42,"column":30},"end":{"row":42,"column":37},"action":"insert","lines":["$asesor"]}],[{"start":{"row":42,"column":38},"end":{"row":42,"column":39},"action":"insert","lines":[" "],"id":916}],[{"start":{"row":42,"column":39},"end":{"row":42,"column":40},"action":"insert","lines":["="],"id":917}],[{"start":{"row":42,"column":40},"end":{"row":42,"column":41},"action":"insert","lines":["="],"id":918}],[{"start":{"row":42,"column":41},"end":{"row":42,"column":42},"action":"insert","lines":[" "],"id":919}],[{"start":{"row":42,"column":42},"end":{"row":42,"column":43},"action":"insert","lines":["0"],"id":920}],[{"start":{"row":41,"column":50},"end":{"row":41,"column":56},"action":"remove","lines":["asesor"],"id":921},{"start":{"row":41,"column":50},"end":{"row":41,"column":51},"action":"insert","lines":["*"]}]]},"ace":{"folds":[],"scrolltop":420,"scrollleft":0,"selection":{"start":{"row":42,"column":45},"end":{"row":42,"column":45},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":true,"wrapToView":true},"firstLineState":{"row":161,"mode":"ace/mode/php"}},"timestamp":1450742533292,"hash":"bc12aa2ae9f47c874c6edf65bc483a50f2479432"}