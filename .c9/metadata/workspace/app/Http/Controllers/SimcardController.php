{"filter":false,"title":"SimcardController.php","tooltip":"/app/Http/Controllers/SimcardController.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":33,"column":38},"end":{"row":33,"column":39},"action":"insert","lines":[";"],"id":618}],[{"start":{"row":33,"column":19},"end":{"row":33,"column":39},"action":"remove","lines":["$simsActivasEsteMes;"],"id":619},{"start":{"row":33,"column":19},"end":{"row":33,"column":31},"action":"insert","lines":["$user->email"]}],[{"start":{"row":33,"column":31},"end":{"row":33,"column":32},"action":"insert","lines":[";"],"id":620}],[{"start":{"row":32,"column":362},"end":{"row":33,"column":32},"action":"remove","lines":["","            return $user->email;"],"id":622}],[{"start":{"row":35,"column":366},"end":{"row":36,"column":32},"action":"insert","lines":["","            return $user->email;"],"id":623}],[{"start":{"row":36,"column":19},"end":{"row":36,"column":31},"action":"remove","lines":["$user->email"],"id":624},{"start":{"row":36,"column":19},"end":{"row":36,"column":38},"action":"insert","lines":["$today->format('m')"]}],[{"start":{"row":36,"column":19},"end":{"row":36,"column":38},"action":"remove","lines":["$today->format('m')"],"id":625},{"start":{"row":36,"column":19},"end":{"row":36,"column":42},"action":"insert","lines":["$simsActivasMesAnterior"]}],[{"start":{"row":32,"column":179},"end":{"row":32,"column":180},"action":"remove","lines":["y"],"id":626}],[{"start":{"row":32,"column":179},"end":{"row":32,"column":180},"action":"insert","lines":["Y"],"id":627}],[{"start":{"row":35,"column":183},"end":{"row":35,"column":184},"action":"remove","lines":["y"],"id":628}],[{"start":{"row":35,"column":183},"end":{"row":35,"column":184},"action":"insert","lines":["Y"],"id":629}],[{"start":{"row":39,"column":183},"end":{"row":39,"column":184},"action":"remove","lines":["y"],"id":630}],[{"start":{"row":39,"column":183},"end":{"row":39,"column":184},"action":"insert","lines":["Y"],"id":631}],[{"start":{"row":44,"column":182},"end":{"row":44,"column":183},"action":"remove","lines":["y"],"id":632}],[{"start":{"row":44,"column":182},"end":{"row":44,"column":183},"action":"insert","lines":["Y"],"id":633}],[{"start":{"row":47,"column":186},"end":{"row":47,"column":187},"action":"remove","lines":["y"],"id":634}],[{"start":{"row":47,"column":186},"end":{"row":47,"column":187},"action":"insert","lines":["Y"],"id":635}],[{"start":{"row":50,"column":186},"end":{"row":50,"column":187},"action":"remove","lines":["y"],"id":636}],[{"start":{"row":50,"column":186},"end":{"row":50,"column":187},"action":"insert","lines":["Y"],"id":637}],[{"start":{"row":57,"column":179},"end":{"row":57,"column":180},"action":"remove","lines":["y"],"id":638}],[{"start":{"row":57,"column":179},"end":{"row":57,"column":180},"action":"insert","lines":["Y"],"id":639}],[{"start":{"row":59,"column":183},"end":{"row":59,"column":184},"action":"remove","lines":["y"],"id":640}],[{"start":{"row":59,"column":183},"end":{"row":59,"column":184},"action":"insert","lines":["Y"],"id":641}],[{"start":{"row":61,"column":183},"end":{"row":61,"column":184},"action":"remove","lines":["y"],"id":642}],[{"start":{"row":61,"column":183},"end":{"row":61,"column":184},"action":"insert","lines":["Y"],"id":643}],[{"start":{"row":66,"column":182},"end":{"row":66,"column":183},"action":"remove","lines":["y"],"id":644}],[{"start":{"row":66,"column":182},"end":{"row":66,"column":183},"action":"insert","lines":["Y"],"id":645}],[{"start":{"row":69,"column":186},"end":{"row":69,"column":187},"action":"remove","lines":["y"],"id":646}],[{"start":{"row":69,"column":186},"end":{"row":69,"column":187},"action":"insert","lines":["Y"],"id":647}],[{"start":{"row":72,"column":186},"end":{"row":72,"column":187},"action":"remove","lines":["y"],"id":648}],[{"start":{"row":72,"column":186},"end":{"row":72,"column":187},"action":"insert","lines":["Y"],"id":649}],[{"start":{"row":35,"column":366},"end":{"row":36,"column":43},"action":"remove","lines":["","            return $simsActivasMesAnterior;"],"id":650}],[{"start":{"row":51,"column":12},"end":{"row":52,"column":0},"action":"insert","lines":["",""],"id":651},{"start":{"row":52,"column":0},"end":{"row":52,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":52,"column":12},"end":{"row":60,"column":26},"action":"insert","lines":["// REVISAR SIMS VENCIDAS","            $simsVencidasEsteMes = \\DB::table('simcards')->where(\\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();","            ","            date_sub($today, date_interval_create_from_date_string('1 month'));","            $simsVencidasMesAnterior = \\DB::table('simcards')->where(\\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();","            ","            date_sub($today, date_interval_create_from_date_string('1 month'));","            $simsVencidas2MesAnterior =\\DB::table('simcards')->where(\\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();","            //------------"],"id":652}],[{"start":{"row":52,"column":28},"end":{"row":52,"column":29},"action":"insert","lines":["D"],"id":653}],[{"start":{"row":52,"column":29},"end":{"row":52,"column":30},"action":"insert","lines":["I"],"id":654}],[{"start":{"row":52,"column":30},"end":{"row":52,"column":31},"action":"insert","lines":["S"],"id":655}],[{"start":{"row":52,"column":31},"end":{"row":52,"column":32},"action":"insert","lines":["P"],"id":656}],[{"start":{"row":52,"column":32},"end":{"row":52,"column":33},"action":"insert","lines":["O"],"id":657}],[{"start":{"row":52,"column":33},"end":{"row":52,"column":34},"action":"insert","lines":["N"],"id":658}],[{"start":{"row":52,"column":34},"end":{"row":52,"column":35},"action":"insert","lines":["I"],"id":659}],[{"start":{"row":52,"column":35},"end":{"row":52,"column":36},"action":"insert","lines":["B"],"id":660}],[{"start":{"row":52,"column":36},"end":{"row":52,"column":37},"action":"insert","lines":["L"],"id":661}],[{"start":{"row":52,"column":37},"end":{"row":52,"column":38},"action":"insert","lines":["E"],"id":662}],[{"start":{"row":51,"column":12},"end":{"row":60,"column":26},"action":"remove","lines":["","            // REVISAR SIMS DISPONIBLEVENCIDAS","            $simsVencidasEsteMes = \\DB::table('simcards')->where(\\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();","            ","            date_sub($today, date_interval_create_from_date_string('1 month'));","            $simsVencidasMesAnterior = \\DB::table('simcards')->where(\\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();","            ","            date_sub($today, date_interval_create_from_date_string('1 month'));","            $simsVencidas2MesAnterior =\\DB::table('simcards')->where(\\DB::raw('MONTH(fecha_vencimiento)'),$today->format('m'))->where(\\DB::raw('YEAR(fecha_vencimiento)'),$today->format('Y'))->where('tipo','1')->join('subdistribuidores','simcards.nombreSubdistribuidor','=','subdistribuidores.nombre')->where('subdistribuidores.emailDistribuidor',$user->email)->count();","            //------------"],"id":677}],[{"start":{"row":90,"column":310},"end":{"row":91,"column":0},"action":"insert","lines":["",""],"id":678},{"start":{"row":91,"column":0},"end":{"row":91,"column":16},"action":"insert","lines":["                "]}],[{"start":{"row":91,"column":16},"end":{"row":91,"column":17},"action":"insert","lines":["r"],"id":679}],[{"start":{"row":91,"column":17},"end":{"row":91,"column":18},"action":"insert","lines":["e"],"id":680}],[{"start":{"row":91,"column":18},"end":{"row":91,"column":19},"action":"insert","lines":["t"],"id":681}],[{"start":{"row":91,"column":19},"end":{"row":91,"column":20},"action":"insert","lines":["u"],"id":682}],[{"start":{"row":91,"column":20},"end":{"row":91,"column":21},"action":"insert","lines":["r"],"id":683}],[{"start":{"row":91,"column":21},"end":{"row":91,"column":22},"action":"insert","lines":["n"],"id":684}],[{"start":{"row":91,"column":22},"end":{"row":91,"column":23},"action":"insert","lines":[" "],"id":685}],[{"start":{"row":91,"column":23},"end":{"row":91,"column":24},"action":"insert","lines":["$"],"id":686}],[{"start":{"row":91,"column":24},"end":{"row":91,"column":25},"action":"insert","lines":["s"],"id":687}],[{"start":{"row":91,"column":25},"end":{"row":91,"column":26},"action":"insert","lines":["i"],"id":688}],[{"start":{"row":91,"column":26},"end":{"row":91,"column":27},"action":"insert","lines":["m"],"id":689}],[{"start":{"row":91,"column":27},"end":{"row":91,"column":28},"action":"insert","lines":[";"],"id":690}],[{"start":{"row":91,"column":16},"end":{"row":91,"column":28},"action":"remove","lines":["return $sim;"],"id":691},{"start":{"row":91,"column":16},"end":{"row":91,"column":17},"action":"insert","lines":["i"]}],[{"start":{"row":91,"column":17},"end":{"row":91,"column":18},"action":"insert","lines":["f"],"id":692}],[{"start":{"row":91,"column":18},"end":{"row":91,"column":19},"action":"insert","lines":["/"],"id":693}],[{"start":{"row":91,"column":19},"end":{"row":91,"column":21},"action":"insert","lines":["()"],"id":694}],[{"start":{"row":91,"column":18},"end":{"row":91,"column":19},"action":"remove","lines":["/"],"id":695}],[{"start":{"row":91,"column":19},"end":{"row":91,"column":20},"action":"insert","lines":["$"],"id":696}],[{"start":{"row":91,"column":20},"end":{"row":91,"column":21},"action":"insert","lines":["s"],"id":697}],[{"start":{"row":91,"column":21},"end":{"row":91,"column":22},"action":"insert","lines":["i"],"id":698}],[{"start":{"row":91,"column":22},"end":{"row":91,"column":23},"action":"insert","lines":["m"],"id":699}],[{"start":{"row":91,"column":23},"end":{"row":91,"column":24},"action":"insert","lines":[" "],"id":700}],[{"start":{"row":91,"column":24},"end":{"row":91,"column":25},"action":"insert","lines":["!"],"id":701}],[{"start":{"row":91,"column":25},"end":{"row":91,"column":26},"action":"insert","lines":["="],"id":702}],[{"start":{"row":91,"column":26},"end":{"row":91,"column":27},"action":"insert","lines":[" "],"id":703}],[{"start":{"row":91,"column":27},"end":{"row":91,"column":28},"action":"insert","lines":["n"],"id":704}],[{"start":{"row":91,"column":28},"end":{"row":91,"column":29},"action":"insert","lines":["u"],"id":705}],[{"start":{"row":91,"column":29},"end":{"row":91,"column":30},"action":"insert","lines":["l"],"id":706}],[{"start":{"row":91,"column":30},"end":{"row":91,"column":31},"action":"insert","lines":["l"],"id":707}],[{"start":{"row":91,"column":32},"end":{"row":91,"column":33},"action":"insert","lines":["{"],"id":708}],[{"start":{"row":115,"column":17},"end":{"row":116,"column":0},"action":"insert","lines":["",""],"id":709},{"start":{"row":116,"column":0},"end":{"row":116,"column":16},"action":"insert","lines":["                "]}],[{"start":{"row":116,"column":16},"end":{"row":116,"column":17},"action":"insert","lines":["}"],"id":710}],[{"start":{"row":92,"column":0},"end":{"row":92,"column":4},"action":"insert","lines":["    "],"id":711},{"start":{"row":93,"column":0},"end":{"row":93,"column":4},"action":"insert","lines":["    "]},{"start":{"row":94,"column":0},"end":{"row":94,"column":4},"action":"insert","lines":["    "]},{"start":{"row":95,"column":0},"end":{"row":95,"column":4},"action":"insert","lines":["    "]},{"start":{"row":96,"column":0},"end":{"row":96,"column":4},"action":"insert","lines":["    "]},{"start":{"row":97,"column":0},"end":{"row":97,"column":4},"action":"insert","lines":["    "]},{"start":{"row":98,"column":0},"end":{"row":98,"column":4},"action":"insert","lines":["    "]},{"start":{"row":99,"column":0},"end":{"row":99,"column":4},"action":"insert","lines":["    "]},{"start":{"row":100,"column":0},"end":{"row":100,"column":4},"action":"insert","lines":["    "]},{"start":{"row":101,"column":0},"end":{"row":101,"column":4},"action":"insert","lines":["    "]},{"start":{"row":102,"column":0},"end":{"row":102,"column":4},"action":"insert","lines":["    "]},{"start":{"row":103,"column":0},"end":{"row":103,"column":4},"action":"insert","lines":["    "]},{"start":{"row":104,"column":0},"end":{"row":104,"column":4},"action":"insert","lines":["    "]},{"start":{"row":105,"column":0},"end":{"row":105,"column":4},"action":"insert","lines":["    "]},{"start":{"row":106,"column":0},"end":{"row":106,"column":4},"action":"insert","lines":["    "]},{"start":{"row":107,"column":0},"end":{"row":107,"column":4},"action":"insert","lines":["    "]},{"start":{"row":108,"column":0},"end":{"row":108,"column":4},"action":"insert","lines":["    "]},{"start":{"row":109,"column":0},"end":{"row":109,"column":4},"action":"insert","lines":["    "]},{"start":{"row":110,"column":0},"end":{"row":110,"column":4},"action":"insert","lines":["    "]},{"start":{"row":111,"column":0},"end":{"row":111,"column":4},"action":"insert","lines":["    "]},{"start":{"row":112,"column":0},"end":{"row":112,"column":4},"action":"insert","lines":["    "]},{"start":{"row":113,"column":0},"end":{"row":113,"column":4},"action":"insert","lines":["    "]},{"start":{"row":114,"column":0},"end":{"row":114,"column":4},"action":"insert","lines":["    "]},{"start":{"row":115,"column":0},"end":{"row":115,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":116,"column":17},"end":{"row":116,"column":18},"action":"insert","lines":["e"],"id":712}],[{"start":{"row":116,"column":18},"end":{"row":116,"column":19},"action":"insert","lines":["l"],"id":713}],[{"start":{"row":116,"column":19},"end":{"row":116,"column":20},"action":"insert","lines":["s"],"id":714}],[{"start":{"row":116,"column":20},"end":{"row":116,"column":21},"action":"insert","lines":["e"],"id":715}],[{"start":{"row":116,"column":21},"end":{"row":116,"column":22},"action":"insert","lines":["{"],"id":716}],[{"start":{"row":116,"column":22},"end":{"row":118,"column":17},"action":"insert","lines":["","                    ","                }"],"id":717}],[{"start":{"row":117,"column":0},"end":{"row":119,"column":0},"action":"insert","lines":["                        $simcard = [];","                        $months= [];",""],"id":718}],[{"start":{"row":118,"column":36},"end":{"row":119,"column":20},"action":"remove","lines":["","                    "],"id":719}],[{"start":{"row":118,"column":0},"end":{"row":118,"column":4},"action":"remove","lines":["    "],"id":720}],[{"start":{"row":117,"column":0},"end":{"row":117,"column":4},"action":"remove","lines":["    "],"id":721}],[{"start":{"row":89,"column":49},"end":{"row":90,"column":0},"action":"insert","lines":["",""],"id":722},{"start":{"row":90,"column":0},"end":{"row":90,"column":16},"action":"insert","lines":["                "]}],[{"start":{"row":90,"column":16},"end":{"row":90,"column":17},"action":"insert","lines":["r"],"id":723}],[{"start":{"row":90,"column":17},"end":{"row":90,"column":18},"action":"insert","lines":["e"],"id":724}],[{"start":{"row":90,"column":18},"end":{"row":90,"column":19},"action":"insert","lines":["t"],"id":725}],[{"start":{"row":90,"column":19},"end":{"row":90,"column":20},"action":"insert","lines":["u"],"id":726}],[{"start":{"row":90,"column":20},"end":{"row":90,"column":21},"action":"insert","lines":["r"],"id":727}],[{"start":{"row":90,"column":21},"end":{"row":90,"column":22},"action":"insert","lines":["n"],"id":728}],[{"start":{"row":90,"column":22},"end":{"row":90,"column":23},"action":"insert","lines":[" "],"id":729}],[{"start":{"row":90,"column":23},"end":{"row":90,"column":47},"action":"insert","lines":["$request['dato_paquete']"],"id":730}],[{"start":{"row":90,"column":47},"end":{"row":90,"column":48},"action":"insert","lines":[";"],"id":731}],[{"start":{"row":89,"column":49},"end":{"row":90,"column":48},"action":"remove","lines":["","                return $request['dato_paquete'];"],"id":732}],[{"start":{"row":92,"column":43},"end":{"row":92,"column":45},"action":"remove","lines":["-1"],"id":733},{"start":{"row":92,"column":43},"end":{"row":92,"column":44},"action":"insert","lines":["0"]}]]},"ace":{"folds":[],"scrolltop":2460,"scrollleft":0,"selection":{"start":{"row":91,"column":33},"end":{"row":91,"column":33},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":true,"wrapToView":true},"firstLineState":{"row":182,"mode":"ace/mode/php"}},"timestamp":1449855573084,"hash":"24bceb39e6ffd8ca18a1f72e20fb31bd0d1d9af6"}