{"filter":false,"title":"FinanzasController.php","tooltip":"/app/Http/Controllers/FinanzasController.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":17,"column":28},"end":{"row":17,"column":29},"action":"insert","lines":["/"],"id":921}],[{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["t"],"id":922}],[{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["e"],"id":923}],[{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["m"],"id":924}],[{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["p"],"id":925}],[{"start":{"row":17,"column":29},"end":{"row":17,"column":30},"action":"remove","lines":["/"],"id":926}],[{"start":{"row":16,"column":8},"end":{"row":16,"column":9},"action":"remove","lines":["/"],"id":927}],[{"start":{"row":16,"column":8},"end":{"row":16,"column":9},"action":"remove","lines":["*"],"id":928}],[{"start":{"row":21,"column":61},"end":{"row":21,"column":62},"action":"remove","lines":["/"],"id":929}],[{"start":{"row":21,"column":60},"end":{"row":21,"column":61},"action":"remove","lines":["*"],"id":930}],[{"start":{"row":21,"column":8},"end":{"row":21,"column":9},"action":"insert","lines":["/"],"id":931}],[{"start":{"row":21,"column":9},"end":{"row":21,"column":10},"action":"insert","lines":["/"],"id":932}],[{"start":{"row":14,"column":8},"end":{"row":16,"column":8},"action":"remove","lines":["$gestor = fopen('/public/temp/temporal.csv', \"r\");","        fclose($gestor);","        "],"id":933}],[{"start":{"row":18,"column":49},"end":{"row":19,"column":0},"action":"insert","lines":["",""],"id":934},{"start":{"row":19,"column":0},"end":{"row":19,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":19,"column":8},"end":{"row":21,"column":8},"action":"insert","lines":["$gestor = fopen('/public/temp/temporal.csv', \"r\");","        fclose($gestor);","        "],"id":935}],[{"start":{"row":21,"column":4},"end":{"row":21,"column":8},"action":"remove","lines":["    "],"id":936}],[{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"remove","lines":["    "],"id":937}],[{"start":{"row":20,"column":24},"end":{"row":21,"column":0},"action":"remove","lines":["",""],"id":938}],[{"start":{"row":19,"column":25},"end":{"row":19,"column":38},"action":"remove","lines":["/public/temp/"],"id":939}],[{"start":{"row":17,"column":14},"end":{"row":17,"column":21},"action":"remove","lines":[" '/' . "],"id":940}],[{"start":{"row":17,"column":14},"end":{"row":17,"column":15},"action":"insert","lines":[" "],"id":941}],[{"start":{"row":15,"column":29},"end":{"row":15,"column":30},"action":"insert","lines":["t"],"id":942}],[{"start":{"row":15,"column":30},"end":{"row":15,"column":31},"action":"insert","lines":["e"],"id":943}],[{"start":{"row":15,"column":31},"end":{"row":15,"column":32},"action":"insert","lines":["m"],"id":944}],[{"start":{"row":15,"column":32},"end":{"row":15,"column":33},"action":"insert","lines":["p"],"id":945}],[{"start":{"row":19,"column":25},"end":{"row":19,"column":26},"action":"insert","lines":["/"],"id":946}],[{"start":{"row":19,"column":26},"end":{"row":19,"column":27},"action":"insert","lines":["t"],"id":947}],[{"start":{"row":19,"column":27},"end":{"row":19,"column":28},"action":"insert","lines":["e"],"id":948}],[{"start":{"row":19,"column":28},"end":{"row":19,"column":29},"action":"insert","lines":["m"],"id":949}],[{"start":{"row":19,"column":29},"end":{"row":19,"column":30},"action":"insert","lines":["p"],"id":950}],[{"start":{"row":19,"column":30},"end":{"row":19,"column":31},"action":"insert","lines":["/"],"id":951}],[{"start":{"row":15,"column":28},"end":{"row":15,"column":29},"action":"remove","lines":["/"],"id":952}],[{"start":{"row":19,"column":25},"end":{"row":19,"column":26},"action":"remove","lines":["/"],"id":953}],[{"start":{"row":18,"column":49},"end":{"row":20,"column":24},"action":"remove","lines":["","        $gestor = fopen('temp/temporal.csv', \"r\");","        fclose($gestor);"],"id":954}],[{"start":{"row":19,"column":8},"end":{"row":19,"column":9},"action":"remove","lines":["/"],"id":955}],[{"start":{"row":19,"column":8},"end":{"row":19,"column":9},"action":"remove","lines":["/"],"id":956}],[{"start":{"row":17,"column":33},"end":{"row":17,"column":34},"action":"insert","lines":[" "],"id":957}],[{"start":{"row":17,"column":34},"end":{"row":17,"column":36},"action":"insert","lines":["''"],"id":958}],[{"start":{"row":17,"column":35},"end":{"row":17,"column":36},"action":"insert","lines":["/"],"id":959}],[{"start":{"row":17,"column":37},"end":{"row":17,"column":38},"action":"insert","lines":["."],"id":960}],[{"start":{"row":17,"column":37},"end":{"row":17,"column":38},"action":"insert","lines":[" "],"id":961}],[{"start":{"row":20,"column":8},"end":{"row":52,"column":9},"action":"remove","lines":["return \\Redirect::route('finanzas');  ","        if (($gestor = fopen($file, \"r\")) !== FALSE) {","            fgetcsv($gestor, 1000, \",\");","            while (($vars = fgetcsv($gestor, 1000, \",\")) !== FALSE) {","               $numero = str_replace('\"', '',$vars[12]);","               $periodo = str_replace('\"', '',$vars[27]);","               try{","                    $simc = \\DB::table('simcards')->where('numero', '=',$numero)->first();","                    if($simc == null){","                        $ICC = \\DB::table('simcards')->select(\\DB::raw('min(ICC) as ICC'))->first();","                        $ICC = $ICC->ICC - 1;","                        \\App\\Simcard::create([","                         'ICC' => $ICC,","                         'numero' => $numero,","                         'fecha_vencimiento' => null,","                         'fecha_activacion' =>  null,","                         'nombreSubdistribuidor' => 'SIN ASIGNAR',","                         'tipo' => 1,","                         'paquete' => 0,","                         'fecha_entrega' => null","                         ]);","                    }","                    \\App\\Comision::create([","                             'ICC' => $simc->ICC,","                             'valor' => $vars[25],","                             'periodo' => $periodo,","                             ]);   ","               }catch(Exception $e){","                   return $e;","               }","            }","            fclose($gestor);","        }"],"id":962}],[{"start":{"row":19,"column":60},"end":{"row":20,"column":8},"action":"remove","lines":["","        "],"id":963}],[{"start":{"row":17,"column":14},"end":{"row":17,"column":15},"action":"insert","lines":[" "],"id":964}],[{"start":{"row":17,"column":15},"end":{"row":17,"column":17},"action":"insert","lines":["''"],"id":965}],[{"start":{"row":17,"column":16},"end":{"row":17,"column":17},"action":"insert","lines":["p"],"id":966}],[{"start":{"row":17,"column":17},"end":{"row":17,"column":18},"action":"insert","lines":["u"],"id":967}],[{"start":{"row":17,"column":18},"end":{"row":17,"column":19},"action":"insert","lines":["b"],"id":968}],[{"start":{"row":17,"column":19},"end":{"row":17,"column":20},"action":"insert","lines":["l"],"id":969}],[{"start":{"row":17,"column":20},"end":{"row":17,"column":21},"action":"insert","lines":["i"],"id":970}],[{"start":{"row":17,"column":21},"end":{"row":17,"column":22},"action":"insert","lines":["c"],"id":971}],[{"start":{"row":17,"column":22},"end":{"row":17,"column":23},"action":"insert","lines":["/"],"id":972}],[{"start":{"row":17,"column":24},"end":{"row":17,"column":25},"action":"insert","lines":[" "],"id":973}],[{"start":{"row":17,"column":25},"end":{"row":17,"column":26},"action":"insert","lines":["."],"id":974}],[{"start":{"row":13,"column":8},"end":{"row":13,"column":103},"action":"insert","lines":["$fecha_vencimiento = date_add(date(\"Y/m/d\"),date_interval_create_from_date_string(\"9 months\"));"],"id":975}],[{"start":{"row":13,"column":103},"end":{"row":14,"column":0},"action":"insert","lines":["",""],"id":976},{"start":{"row":14,"column":0},"end":{"row":14,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":14,"column":8},"end":{"row":14,"column":9},"action":"insert","lines":["r"],"id":977}],[{"start":{"row":14,"column":9},"end":{"row":14,"column":10},"action":"insert","lines":["e"],"id":978}],[{"start":{"row":14,"column":10},"end":{"row":14,"column":11},"action":"insert","lines":["t"],"id":979}],[{"start":{"row":14,"column":11},"end":{"row":14,"column":12},"action":"insert","lines":["u"],"id":980}],[{"start":{"row":14,"column":12},"end":{"row":14,"column":13},"action":"insert","lines":["r"],"id":981}],[{"start":{"row":14,"column":13},"end":{"row":14,"column":14},"action":"insert","lines":["n"],"id":982}],[{"start":{"row":14,"column":14},"end":{"row":14,"column":15},"action":"insert","lines":[" "],"id":983}],[{"start":{"row":14,"column":15},"end":{"row":14,"column":16},"action":"insert","lines":["$"],"id":984}],[{"start":{"row":14,"column":16},"end":{"row":14,"column":17},"action":"insert","lines":["f"],"id":985}],[{"start":{"row":14,"column":17},"end":{"row":14,"column":18},"action":"insert","lines":["e"],"id":986}],[{"start":{"row":14,"column":18},"end":{"row":14,"column":19},"action":"insert","lines":["c"],"id":987}],[{"start":{"row":14,"column":19},"end":{"row":14,"column":20},"action":"insert","lines":["h"],"id":988}],[{"start":{"row":14,"column":15},"end":{"row":14,"column":20},"action":"remove","lines":["$fech"],"id":989},{"start":{"row":14,"column":15},"end":{"row":14,"column":33},"action":"insert","lines":["$fecha_vencimiento"]}],[{"start":{"row":14,"column":33},"end":{"row":14,"column":34},"action":"insert","lines":[";"],"id":990}],[{"start":{"row":13,"column":38},"end":{"row":13,"column":51},"action":"remove","lines":["date(\"Y/m/d\")"],"id":991},{"start":{"row":13,"column":38},"end":{"row":13,"column":56},"action":"insert","lines":["new DateTime($now)"]}],[{"start":{"row":13,"column":42},"end":{"row":13,"column":43},"action":"insert","lines":["\\"],"id":992}],[{"start":{"row":13,"column":43},"end":{"row":13,"column":44},"action":"insert","lines":["A"],"id":993}],[{"start":{"row":13,"column":44},"end":{"row":13,"column":45},"action":"insert","lines":["p"],"id":994}],[{"start":{"row":13,"column":45},"end":{"row":13,"column":46},"action":"insert","lines":["p"],"id":995}],[{"start":{"row":13,"column":46},"end":{"row":13,"column":47},"action":"insert","lines":["\\"],"id":996}],[{"start":{"row":13,"column":46},"end":{"row":13,"column":47},"action":"remove","lines":["\\"],"id":997}],[{"start":{"row":13,"column":45},"end":{"row":13,"column":46},"action":"remove","lines":["p"],"id":998}],[{"start":{"row":13,"column":44},"end":{"row":13,"column":45},"action":"remove","lines":["p"],"id":999}],[{"start":{"row":13,"column":43},"end":{"row":13,"column":44},"action":"remove","lines":["A"],"id":1000}],[{"start":{"row":13,"column":52},"end":{"row":13,"column":56},"action":"remove","lines":["$now"],"id":1001},{"start":{"row":13,"column":52},"end":{"row":13,"column":53},"action":"insert","lines":["'"]}],[{"start":{"row":13,"column":53},"end":{"row":13,"column":54},"action":"insert","lines":["N"],"id":1002}],[{"start":{"row":13,"column":54},"end":{"row":13,"column":55},"action":"insert","lines":["O"],"id":1003}],[{"start":{"row":13,"column":55},"end":{"row":13,"column":56},"action":"insert","lines":["W"],"id":1004}],[{"start":{"row":13,"column":56},"end":{"row":13,"column":57},"action":"insert","lines":["0"],"id":1005}],[{"start":{"row":13,"column":56},"end":{"row":13,"column":57},"action":"remove","lines":["0"],"id":1006}],[{"start":{"row":13,"column":56},"end":{"row":13,"column":57},"action":"insert","lines":["'"],"id":1007}],[{"start":{"row":13,"column":110},"end":{"row":14,"column":34},"action":"remove","lines":["","        return $fecha_vencimiento;"],"id":1008}],[{"start":{"row":13,"column":110},"end":{"row":14,"column":0},"action":"insert","lines":["",""],"id":1011},{"start":{"row":14,"column":0},"end":{"row":14,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":14,"column":8},"end":{"row":14,"column":9},"action":"insert","lines":["r"],"id":1012}],[{"start":{"row":14,"column":9},"end":{"row":14,"column":10},"action":"insert","lines":["e"],"id":1013}],[{"start":{"row":14,"column":10},"end":{"row":14,"column":11},"action":"insert","lines":["t"],"id":1014}],[{"start":{"row":14,"column":11},"end":{"row":14,"column":12},"action":"insert","lines":["u"],"id":1015}],[{"start":{"row":14,"column":12},"end":{"row":14,"column":13},"action":"insert","lines":["r"],"id":1016}],[{"start":{"row":14,"column":13},"end":{"row":14,"column":14},"action":"insert","lines":["n"],"id":1017}],[{"start":{"row":14,"column":14},"end":{"row":14,"column":15},"action":"insert","lines":[" "],"id":1018}],[{"start":{"row":14,"column":15},"end":{"row":14,"column":35},"action":"insert","lines":[">format('Y-m-d H:i')"],"id":1019}],[{"start":{"row":14,"column":15},"end":{"row":14,"column":33},"action":"insert","lines":["$fecha_vencimiento"],"id":1020}],[{"start":{"row":14,"column":33},"end":{"row":14,"column":34},"action":"insert","lines":["-"],"id":1021}],[{"start":{"row":14,"column":54},"end":{"row":14,"column":55},"action":"insert","lines":[";"],"id":1022}],[{"start":{"row":12,"column":46},"end":{"row":14,"column":55},"action":"remove","lines":["","        $fecha_vencimiento = date_add(new \\DateTime('NOW'),date_interval_create_from_date_string(\"9 months\"));","        return $fecha_vencimiento->format('Y-m-d H:i');"],"id":1023}]]},"ace":{"folds":[],"scrolltop":57,"scrollleft":0,"selection":{"start":{"row":20,"column":5},"end":{"row":20,"column":5},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":12,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1450139454368,"hash":"f6680798ecff89a99c3f735abe00f97a59ee28f5"}