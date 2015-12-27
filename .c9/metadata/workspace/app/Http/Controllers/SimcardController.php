{"filter":false,"title":"SimcardController.php","tooltip":"/app/Http/Controllers/SimcardController.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":11,"column":27},"end":{"row":11,"column":28},"action":"insert","lines":["g"],"id":385}],[{"start":{"row":11,"column":28},"end":{"row":11,"column":29},"action":"insert","lines":["a"],"id":386}],[{"start":{"row":11,"column":29},"end":{"row":11,"column":30},"action":"insert","lines":["r"],"id":387}],[{"start":{"row":11,"column":30},"end":{"row":11,"column":31},"action":"insert","lines":["S"],"id":388}],[{"start":{"row":11,"column":30},"end":{"row":11,"column":31},"action":"remove","lines":["S"],"id":389}],[{"start":{"row":11,"column":30},"end":{"row":11,"column":31},"action":"insert","lines":["P"],"id":390}],[{"start":{"row":11,"column":31},"end":{"row":11,"column":32},"action":"insert","lines":["r"],"id":391}],[{"start":{"row":11,"column":32},"end":{"row":11,"column":33},"action":"insert","lines":["o"],"id":392}],[{"start":{"row":11,"column":33},"end":{"row":11,"column":34},"action":"insert","lines":["x"],"id":393}],[{"start":{"row":11,"column":34},"end":{"row":11,"column":35},"action":"insert","lines":["i"],"id":394}],[{"start":{"row":11,"column":35},"end":{"row":11,"column":36},"action":"insert","lines":["m"],"id":395}],[{"start":{"row":11,"column":36},"end":{"row":11,"column":37},"action":"insert","lines":["a"],"id":396}],[{"start":{"row":11,"column":37},"end":{"row":11,"column":38},"action":"insert","lines":["s"],"id":397}],[{"start":{"row":11,"column":38},"end":{"row":11,"column":39},"action":"insert","lines":["V"],"id":398}],[{"start":{"row":11,"column":39},"end":{"row":11,"column":40},"action":"insert","lines":["e"],"id":399}],[{"start":{"row":11,"column":40},"end":{"row":11,"column":41},"action":"insert","lines":["n"],"id":400}],[{"start":{"row":11,"column":41},"end":{"row":11,"column":42},"action":"insert","lines":["c"],"id":401}],[{"start":{"row":11,"column":42},"end":{"row":11,"column":43},"action":"insert","lines":["e"],"id":402}],[{"start":{"row":11,"column":43},"end":{"row":11,"column":44},"action":"insert","lines":["r"],"id":403}],[{"start":{"row":14,"column":499},"end":{"row":15,"column":0},"action":"insert","lines":["",""],"id":404},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":15,"column":4},"end":{"row":15,"column":5},"action":"insert","lines":["}"],"id":405},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"remove","lines":["    "]},{"start":{"row":15,"column":0},"end":{"row":15,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"remove","lines":["    "],"id":406}],[{"start":{"row":14,"column":499},"end":{"row":15,"column":0},"action":"insert","lines":["",""],"id":407},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":15,"column":4},"end":{"row":15,"column":5},"action":"insert","lines":["}"],"id":408},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"remove","lines":["    "]},{"start":{"row":15,"column":0},"end":{"row":15,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":13,"column":29},"end":{"row":14,"column":0},"action":"insert","lines":["",""],"id":409},{"start":{"row":14,"column":0},"end":{"row":14,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":14,"column":12},"end":{"row":14,"column":33},"action":"insert","lines":["$datos = \\DB::select("],"id":410}],[{"start":{"row":15,"column":4},"end":{"row":15,"column":499},"action":"remove","lines":["select users.name, simcards.numero, simcards.fecha_vencimiento, datediff(simcards.fecha_vencimiento,curdate()) from simcards inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where datediff(simcards.fecha_vencimiento,curdate()) < 90 and datediff(simcards.fecha_vencimiento,curdate()) > 0 and simcards.fecha_activacion is not null order by datediff(simcards.fecha_vencimiento,curdate())"],"id":411}],[{"start":{"row":14,"column":33},"end":{"row":14,"column":35},"action":"insert","lines":["\"\""],"id":412}],[{"start":{"row":14,"column":34},"end":{"row":14,"column":529},"action":"insert","lines":["select users.name, simcards.numero, simcards.fecha_vencimiento, datediff(simcards.fecha_vencimiento,curdate()) from simcards inner join subdistribuidores on simcards.nombreSubdistribuidor = subdistribuidores.nombre inner join users on subdistribuidores.emailDistribuidor = users.email where datediff(simcards.fecha_vencimiento,curdate()) < 90 and datediff(simcards.fecha_vencimiento,curdate()) > 0 and simcards.fecha_activacion is not null order by datediff(simcards.fecha_vencimiento,curdate())"],"id":413}],[{"start":{"row":14,"column":530},"end":{"row":14,"column":531},"action":"insert","lines":[")"],"id":414}],[{"start":{"row":14,"column":531},"end":{"row":14,"column":532},"action":"insert","lines":[";"],"id":415}],[{"start":{"row":14,"column":532},"end":{"row":15,"column":0},"action":"insert","lines":["",""],"id":416},{"start":{"row":15,"column":0},"end":{"row":15,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":15,"column":12},"end":{"row":23,"column":28},"action":"insert","lines":["$myfile = fopen(\"temp/cartera.csv\", \"w\");","            fwrite($myfile, $distribuidor . \"\\n\");","            fwrite($myfile,\"FECHA,DESCRIPCION,CANTIDAD,V. UNITARIO,TOTAL\\n\");","            foreach($registros as $registro){","                $total += $registro->valor_unitario*$registro->cantidad;","                fwrite($myfile, $registro->fecha . \";\" . $registro->descripcion . \";\" . $registro->cantidad . \";\" . $registro->valor_unitario . \";\" . $registro->valor_unitario*$registro->cantidad . \"\\n\");","            }","            fwrite($myfile, \", TOTAL GENERAL,\" + $total + \" \\n\");","            fclose($myfile);"],"id":417}],[{"start":{"row":15,"column":34},"end":{"row":15,"column":41},"action":"remove","lines":["cartera"],"id":418},{"start":{"row":15,"column":34},"end":{"row":15,"column":35},"action":"insert","lines":["s"]}],[{"start":{"row":15,"column":35},"end":{"row":15,"column":36},"action":"insert","lines":["i"],"id":419}],[{"start":{"row":15,"column":36},"end":{"row":15,"column":37},"action":"insert","lines":["m"],"id":420}],[{"start":{"row":15,"column":37},"end":{"row":15,"column":38},"action":"insert","lines":["c"],"id":421}],[{"start":{"row":15,"column":38},"end":{"row":15,"column":39},"action":"insert","lines":["a"],"id":422}],[{"start":{"row":15,"column":39},"end":{"row":15,"column":40},"action":"insert","lines":["r"],"id":423}],[{"start":{"row":15,"column":40},"end":{"row":15,"column":41},"action":"insert","lines":["s"],"id":424}],[{"start":{"row":15,"column":40},"end":{"row":15,"column":41},"action":"remove","lines":["s"],"id":425}],[{"start":{"row":15,"column":40},"end":{"row":15,"column":41},"action":"insert","lines":["d"],"id":426}],[{"start":{"row":15,"column":41},"end":{"row":15,"column":42},"action":"insert","lines":["s"],"id":427}],[{"start":{"row":15,"column":42},"end":{"row":15,"column":43},"action":"insert","lines":["V"],"id":428}],[{"start":{"row":15,"column":43},"end":{"row":15,"column":44},"action":"insert","lines":["e"],"id":429}],[{"start":{"row":15,"column":44},"end":{"row":15,"column":45},"action":"insert","lines":["n"],"id":430}],[{"start":{"row":15,"column":45},"end":{"row":15,"column":46},"action":"insert","lines":["c"],"id":431}],[{"start":{"row":15,"column":46},"end":{"row":15,"column":47},"action":"insert","lines":["e"],"id":432}],[{"start":{"row":15,"column":47},"end":{"row":15,"column":48},"action":"insert","lines":["r"],"id":433}],[{"start":{"row":15,"column":60},"end":{"row":16,"column":50},"action":"remove","lines":["","            fwrite($myfile, $distribuidor . \"\\n\");"],"id":434}],[{"start":{"row":15,"column":60},"end":{"row":16,"column":77},"action":"remove","lines":["","            fwrite($myfile,\"FECHA,DESCRIPCION,CANTIDAD,V. UNITARIO,TOTAL\\n\");"],"id":435}],[{"start":{"row":16,"column":20},"end":{"row":16,"column":30},"action":"remove","lines":["$registros"],"id":436},{"start":{"row":16,"column":20},"end":{"row":16,"column":26},"action":"insert","lines":["$datos"]}],[{"start":{"row":16,"column":41},"end":{"row":17,"column":72},"action":"remove","lines":["","                $total += $registro->valor_unitario*$registro->cantidad;"],"id":437}],[{"start":{"row":17,"column":43},"end":{"row":17,"column":48},"action":"remove","lines":["fecha"],"id":438},{"start":{"row":17,"column":43},"end":{"row":17,"column":44},"action":"insert","lines":["n"]}],[{"start":{"row":17,"column":44},"end":{"row":17,"column":45},"action":"insert","lines":["a"],"id":439}],[{"start":{"row":17,"column":45},"end":{"row":17,"column":46},"action":"insert","lines":["m"],"id":440}],[{"start":{"row":17,"column":46},"end":{"row":17,"column":47},"action":"insert","lines":["e"],"id":441}],[{"start":{"row":17,"column":67},"end":{"row":17,"column":78},"action":"remove","lines":["descripcion"],"id":442},{"start":{"row":17,"column":67},"end":{"row":17,"column":68},"action":"insert","lines":["n"]}],[{"start":{"row":17,"column":68},"end":{"row":17,"column":69},"action":"insert","lines":["u"],"id":443}],[{"start":{"row":17,"column":69},"end":{"row":17,"column":70},"action":"insert","lines":["m"],"id":444}],[{"start":{"row":17,"column":70},"end":{"row":17,"column":71},"action":"insert","lines":["e"],"id":445}],[{"start":{"row":17,"column":71},"end":{"row":17,"column":72},"action":"insert","lines":["r"],"id":446}],[{"start":{"row":17,"column":72},"end":{"row":17,"column":73},"action":"insert","lines":["o"],"id":447}],[{"start":{"row":17,"column":93},"end":{"row":17,"column":101},"action":"remove","lines":["cantidad"],"id":448},{"start":{"row":17,"column":93},"end":{"row":17,"column":94},"action":"insert","lines":["f"]}],[{"start":{"row":17,"column":94},"end":{"row":17,"column":95},"action":"insert","lines":["e"],"id":449}],[{"start":{"row":17,"column":95},"end":{"row":17,"column":96},"action":"insert","lines":["c"],"id":450}],[{"start":{"row":17,"column":96},"end":{"row":17,"column":97},"action":"insert","lines":["h"],"id":451}],[{"start":{"row":17,"column":97},"end":{"row":17,"column":98},"action":"insert","lines":["a"],"id":452}],[{"start":{"row":17,"column":93},"end":{"row":17,"column":98},"action":"remove","lines":["fecha"],"id":453},{"start":{"row":17,"column":93},"end":{"row":17,"column":110},"action":"insert","lines":["fecha_vencimiento"]}],[{"start":{"row":14,"column":144},"end":{"row":14,"column":145},"action":"insert","lines":[" "],"id":454}],[{"start":{"row":14,"column":145},"end":{"row":14,"column":146},"action":"insert","lines":["d"],"id":455}],[{"start":{"row":14,"column":146},"end":{"row":14,"column":147},"action":"insert","lines":["i"],"id":456}],[{"start":{"row":14,"column":147},"end":{"row":14,"column":148},"action":"insert","lines":["f"],"id":457}],[{"start":{"row":14,"column":148},"end":{"row":14,"column":149},"action":"insert","lines":["e"],"id":458}],[{"start":{"row":14,"column":149},"end":{"row":14,"column":150},"action":"insert","lines":["r"],"id":459}],[{"start":{"row":14,"column":150},"end":{"row":14,"column":151},"action":"insert","lines":["e"],"id":460}],[{"start":{"row":14,"column":151},"end":{"row":14,"column":152},"action":"insert","lines":["n"],"id":461}],[{"start":{"row":14,"column":152},"end":{"row":14,"column":153},"action":"insert","lines":["c"],"id":462}],[{"start":{"row":14,"column":153},"end":{"row":14,"column":154},"action":"insert","lines":["i"],"id":463}],[{"start":{"row":14,"column":154},"end":{"row":14,"column":155},"action":"insert","lines":["a"],"id":464}],[{"start":{"row":17,"column":130},"end":{"row":17,"column":144},"action":"remove","lines":["valor_unitario"],"id":465},{"start":{"row":17,"column":130},"end":{"row":17,"column":131},"action":"insert","lines":["d"]}],[{"start":{"row":17,"column":131},"end":{"row":17,"column":132},"action":"insert","lines":["i"],"id":466}],[{"start":{"row":17,"column":132},"end":{"row":17,"column":133},"action":"insert","lines":["f"],"id":467}],[{"start":{"row":17,"column":133},"end":{"row":17,"column":134},"action":"insert","lines":["e"],"id":468}],[{"start":{"row":17,"column":134},"end":{"row":17,"column":135},"action":"insert","lines":["r"],"id":469}],[{"start":{"row":17,"column":135},"end":{"row":17,"column":136},"action":"insert","lines":["e"],"id":470}],[{"start":{"row":17,"column":130},"end":{"row":17,"column":136},"action":"remove","lines":["difere"],"id":471},{"start":{"row":17,"column":130},"end":{"row":17,"column":140},"action":"insert","lines":["diferencia"]}],[{"start":{"row":17,"column":140},"end":{"row":17,"column":195},"action":"remove","lines":[" . \";\" . $registro->valor_unitario*$registro->cantidad "],"id":472}],[{"start":{"row":17,"column":140},"end":{"row":17,"column":141},"action":"insert","lines":[" "],"id":473}],[{"start":{"row":18,"column":13},"end":{"row":19,"column":65},"action":"remove","lines":["","            fwrite($myfile, \", TOTAL GENERAL,\" + $total + \" \\n\");"],"id":474}],[{"start":{"row":19,"column":28},"end":{"row":20,"column":4},"action":"remove","lines":["","    "],"id":475}],[{"start":{"row":19,"column":28},"end":{"row":20,"column":0},"action":"insert","lines":["",""],"id":476},{"start":{"row":20,"column":0},"end":{"row":20,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":20,"column":12},"end":{"row":20,"column":13},"action":"insert","lines":["r"],"id":477}],[{"start":{"row":20,"column":13},"end":{"row":20,"column":14},"action":"insert","lines":["e"],"id":478}],[{"start":{"row":20,"column":14},"end":{"row":20,"column":15},"action":"insert","lines":["t"],"id":479}],[{"start":{"row":20,"column":15},"end":{"row":20,"column":16},"action":"insert","lines":["u"],"id":480}],[{"start":{"row":20,"column":16},"end":{"row":20,"column":17},"action":"insert","lines":["r"],"id":481}],[{"start":{"row":20,"column":17},"end":{"row":20,"column":18},"action":"insert","lines":["n"],"id":482}],[{"start":{"row":20,"column":18},"end":{"row":20,"column":19},"action":"insert","lines":[" "],"id":483}],[{"start":{"row":20,"column":19},"end":{"row":20,"column":20},"action":"insert","lines":["1"],"id":484}],[{"start":{"row":20,"column":20},"end":{"row":20,"column":21},"action":"insert","lines":[";"],"id":485}]]},"ace":{"folds":[],"scrolltop":92,"scrollleft":0,"selection":{"start":{"row":20,"column":21},"end":{"row":20,"column":21},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":true,"wrapToView":true},"firstLineState":{"row":4,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1451185724854,"hash":"913f7dfe2d8c311cc60f2178d292b353f9542dd8"}