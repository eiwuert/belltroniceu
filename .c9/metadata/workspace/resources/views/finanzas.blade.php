{"filter":false,"title":"finanzas.blade.php","tooltip":"/resources/views/finanzas.blade.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":142,"column":146},"end":{"row":142,"column":147},"action":"insert","lines":[";"],"id":2760}],[{"start":{"row":142,"column":147},"end":{"row":142,"column":165},"action":"insert","lines":["margin-bottom:10px"],"id":2761}],[{"start":{"row":142,"column":86},"end":{"row":142,"column":87},"action":"insert","lines":[";"],"id":2762}],[{"start":{"row":142,"column":87},"end":{"row":142,"column":88},"action":"insert","lines":["c"],"id":2763}],[{"start":{"row":142,"column":88},"end":{"row":142,"column":89},"action":"insert","lines":["o"],"id":2764}],[{"start":{"row":142,"column":89},"end":{"row":142,"column":90},"action":"insert","lines":["l"],"id":2765}],[{"start":{"row":142,"column":90},"end":{"row":142,"column":91},"action":"insert","lines":["o"],"id":2766}],[{"start":{"row":142,"column":91},"end":{"row":142,"column":92},"action":"insert","lines":["r"],"id":2767}],[{"start":{"row":142,"column":92},"end":{"row":142,"column":93},"action":"insert","lines":[":"],"id":2768}],[{"start":{"row":142,"column":93},"end":{"row":142,"column":94},"action":"insert","lines":["#"],"id":2769}],[{"start":{"row":142,"column":94},"end":{"row":142,"column":95},"action":"insert","lines":["F"],"id":2770}],[{"start":{"row":142,"column":95},"end":{"row":142,"column":96},"action":"insert","lines":["F"],"id":2771}],[{"start":{"row":142,"column":96},"end":{"row":142,"column":97},"action":"insert","lines":["F"],"id":2772}],[{"start":{"row":142,"column":176},"end":{"row":142,"column":187},"action":"insert","lines":[";color:#FFF"],"id":2773}],[{"start":{"row":161,"column":4},"end":{"row":240,"column":14},"action":"remove","lines":["","    <!-- SECCION FINANZAS SUBS  -->","    <section id=\"finanzas_subs\" class=\"parallex\">","        <div class=\"container\">","            <div class=\"row\">","                <div class=\"col-lg-12 text-center\">","                    <h2 class=\"section-heading\">Ganancias subdistribuidores</h2>","                    <h3 class=\"section-subheading text-muted\" style=\"color:black;margin-bottom:0\">Selecciona un subdistribuidor y un periodo para ver las ganancias en el gráfico.</h3>","                    <h3 class=\"section-subheading text-muted\" style=\"color:black;margin-bottom:20px\">En primer lugar veras el total ganado y en segundo lugar el total despues de impuestos <strong>(1% retención a la comisión + 4.14% ICA).</strong></h3>","                </div>","            </div>","            <div class=\"row text-center \">","                <div class=\"col-md-4\" style=\"display: inline-block;vertical-align: middle;float: none;\">","                    <div id=\"search_container\" class = \"search_container\">","                        <h3 class = \"section_body_content white\" style=\"margin-top:0\">Elige un subdistribuidor</h3>","                        @if($user->isAdmin)","                        <select class=\"selectpicker\" data-width=\"100%\" data-style=\"data\" id =\"subPicker_subdistri\">","                            @foreach ($distribuidores as $distribuidor)","                            <optgroup label=\"{{$distribuidor->name}}\">","                                @foreach ($subdistribuidores[$distribuidor->name] as $subdistribuidor)","                                <option>{{$subdistribuidor->nombre}}</option>","                                @endforeach","                            </optgroup>","                            @endforeach","                        </select>","                        @else","                        <select class=\"selectpicker\" data-width=\"100%\" data-style=\"data\" id =\"subPicker_subdistri\">","                            @foreach ($subdistribuidores as $subdistribuidor)","                            <option>{{$subdistribuidor->nombre}}</option>","                            @endforeach","                        </select>","                        @endif","                        <select class=\"selectpicker\" data-width=\"100%\" data-style=\"data\" id =\"subPicker_periodo\">","                            @foreach ($periodos as $periodo)","                            <option>{{$periodo->periodo}}</option>","                            @endforeach","                        </select>","                        <button class=\"button button_assign\" onClick=\"consultar_subdistribuidor()\" style=\"height:42px;width:100px;margin:0 auto\">Consultar</button>","                    </div>","                </div>","                <div class=\"col-md-4\" style=\"display: inline-block;vertical-align: middle;float: none;\">","                    <div id=\"search_container\" class = \"search_container\" style=\"padding: 5px 0\">","                        <label style=\"color:white;width:45%;margin-top:5px\">Prepago</label>","                        <label style=\"color:white;width:45%;margin-top:5px\">Libre</label>","                        <input class = \"data_estado\" id = \"total_dis_prepago\" disabled=true placeholder =\"Distribuidor\" >","                        <input class = \"data_estado\" id = \"total_dis_libre\" disabled=true placeholder =\"Distribuidor\" >","                        <input class = \"data_estado\" id = \"total_sub_prepago\" disabled=true placeholder=\"Subdisitribuidor\" style=\"color:white\">","                        <input class = \"data_estado\" id = \"total_sub_libre\" disabled=true placeholder =\"Subdistribuidor\" style=\"margin-top:10px\">","                        <hr>","                        <input class = \"data_estado\" id = \"total_dis_prepago_at\" disabled=true placeholder =\"Distribuidor\" >","                        <input class = \"data_estado\" id = \"total_dis_libre_at\" disabled=true placeholder =\"Distribuidor\" >","                        <input class = \"data_estado\" id = \"total_sub_prepago_at\" disabled=true placeholder=\"Subdisitribuidor\" style=\"color:white\">","                        <input class = \"data_estado\" id = \"total_sub_libre_at\" disabled=true placeholder =\"Subdistribuidor\" style=\"margin-top:10px\">","                    </div>","                </div>","            </div>","            <div class=\"row text-center\" style=\"margin-top:20px\">","                <div class=\"col-md-4\" style=\"display: inline-block;vertical-align: middle;float: none;\">","                    <div style=\"display: inline-block;vertical-align: middle;float:none;margin: 0 20px\">","                        <div style=\"width:250px;height:250px\">","                            <canvas id=\"canvasPrepago\"></canvas>","                        </div>","                        <div class=\"portfolio-caption\">","                            <h4 style =\"text-align:center;\">Prepago Pack</h4>","                        </div>","                    </div>","                </div>","                <div class=\"col-md-4\" style=\"display: inline-block;vertical-align: middle;float: none;\">","                    <div style=\"display: inline-block;vertical-align: middle;float:none;margin: 0 20px\">","                        <div style=\"width:250px;height:250px\">","                            <canvas id=\"canvasLibre\"></canvas>","                        </div>","                        <div class=\"portfolio-caption\">","                            <h4 style =\"text-align:center;\">Libre</h4>","                        </div>","                    </div>","                </div>","            </div>","        </div>","    </section>"],"id":2774}],[{"start":{"row":134,"column":92},"end":{"row":134,"column":93},"action":"insert","lines":["_"],"id":2775}],[{"start":{"row":134,"column":93},"end":{"row":134,"column":94},"action":"insert","lines":["a"],"id":2776}],[{"start":{"row":134,"column":94},"end":{"row":134,"column":95},"action":"insert","lines":["d"],"id":2777}],[{"start":{"row":134,"column":95},"end":{"row":134,"column":96},"action":"insert","lines":["m"],"id":2778}],[{"start":{"row":134,"column":96},"end":{"row":134,"column":97},"action":"insert","lines":["i"],"id":2779}],[{"start":{"row":134,"column":97},"end":{"row":134,"column":98},"action":"insert","lines":["n"],"id":2780}],[{"start":{"row":133,"column":33},"end":{"row":134,"column":0},"action":"insert","lines":["",""],"id":2781},{"start":{"row":134,"column":0},"end":{"row":134,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":134,"column":24},"end":{"row":134,"column":25},"action":"insert","lines":["$"],"id":2782}],[{"start":{"row":134,"column":25},"end":{"row":134,"column":26},"action":"insert","lines":["i"],"id":2783}],[{"start":{"row":134,"column":26},"end":{"row":134,"column":27},"action":"insert","lines":["f"],"id":2784}],[{"start":{"row":134,"column":24},"end":{"row":134,"column":27},"action":"remove","lines":["$if"],"id":2785},{"start":{"row":134,"column":24},"end":{"row":134,"column":43},"action":"insert","lines":["@if($user->isAdmin)"]}],[{"start":{"row":135,"column":152},"end":{"row":136,"column":0},"action":"insert","lines":["",""],"id":2786},{"start":{"row":136,"column":0},"end":{"row":136,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":136,"column":24},"end":{"row":136,"column":25},"action":"insert","lines":["@"],"id":2787}],[{"start":{"row":136,"column":25},"end":{"row":136,"column":26},"action":"insert","lines":["e"],"id":2788}],[{"start":{"row":136,"column":26},"end":{"row":136,"column":27},"action":"insert","lines":["l"],"id":2789}],[{"start":{"row":136,"column":27},"end":{"row":136,"column":28},"action":"insert","lines":["s"],"id":2790}],[{"start":{"row":136,"column":28},"end":{"row":136,"column":29},"action":"insert","lines":["e"],"id":2791}],[{"start":{"row":136,"column":29},"end":{"row":137,"column":0},"action":"insert","lines":["",""],"id":2792},{"start":{"row":137,"column":0},"end":{"row":137,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":137,"column":24},"end":{"row":138,"column":0},"action":"insert","lines":["",""],"id":2793},{"start":{"row":138,"column":0},"end":{"row":138,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":138,"column":24},"end":{"row":138,"column":25},"action":"insert","lines":["@"],"id":2794}],[{"start":{"row":138,"column":25},"end":{"row":138,"column":26},"action":"insert","lines":["e"],"id":2795}],[{"start":{"row":138,"column":26},"end":{"row":138,"column":27},"action":"insert","lines":["n"],"id":2796}],[{"start":{"row":138,"column":27},"end":{"row":138,"column":28},"action":"insert","lines":["d"],"id":2797}],[{"start":{"row":137,"column":24},"end":{"row":137,"column":152},"action":"insert","lines":["<button class=\"button button_assign\" onClick=\"consultar_distribuidor_admin()\" style=\";width:100px;padding:0;\">Consultar</button>"],"id":2798}],[{"start":{"row":137,"column":93},"end":{"row":137,"column":97},"action":"remove","lines":["admi"],"id":2799}],[{"start":{"row":137,"column":92},"end":{"row":137,"column":93},"action":"remove","lines":["_"],"id":2800}],[{"start":{"row":137,"column":92},"end":{"row":137,"column":93},"action":"remove","lines":["n"],"id":2801}],[{"start":{"row":135,"column":70},"end":{"row":135,"column":98},"action":"remove","lines":["consultar_distribuidor_admin"],"id":2802},{"start":{"row":135,"column":70},"end":{"row":135,"column":98},"action":"insert","lines":["consultar_distribuidor_admin"]}],[{"start":{"row":135,"column":70},"end":{"row":135,"column":98},"action":"remove","lines":["consultar_distribuidor_admin"],"id":2803},{"start":{"row":135,"column":70},"end":{"row":135,"column":92},"action":"insert","lines":["consultar_distribuidor"]}],[{"start":{"row":135,"column":93},"end":{"row":135,"column":94},"action":"insert","lines":["1"],"id":2804}],[{"start":{"row":137,"column":93},"end":{"row":137,"column":94},"action":"insert","lines":["0"],"id":2805}],[{"start":{"row":137,"column":93},"end":{"row":137,"column":94},"action":"remove","lines":["0"],"id":2806}],[{"start":{"row":135,"column":93},"end":{"row":135,"column":94},"action":"remove","lines":["1"],"id":2807}],[{"start":{"row":135,"column":92},"end":{"row":135,"column":93},"action":"insert","lines":["_"],"id":2808}],[{"start":{"row":135,"column":93},"end":{"row":135,"column":94},"action":"insert","lines":["a"],"id":2809}],[{"start":{"row":135,"column":94},"end":{"row":135,"column":95},"action":"insert","lines":["d"],"id":2810}],[{"start":{"row":135,"column":95},"end":{"row":135,"column":96},"action":"insert","lines":["m"],"id":2811}],[{"start":{"row":135,"column":96},"end":{"row":135,"column":97},"action":"insert","lines":["i"],"id":2812}],[{"start":{"row":135,"column":97},"end":{"row":135,"column":98},"action":"insert","lines":["n"],"id":2813}],[{"start":{"row":121,"column":105},"end":{"row":121,"column":106},"action":"remove","lines":["b"],"id":2814}],[{"start":{"row":121,"column":104},"end":{"row":121,"column":105},"action":"remove","lines":["u"],"id":2815}],[{"start":{"row":121,"column":103},"end":{"row":121,"column":104},"action":"remove","lines":["s"],"id":2816}],[{"start":{"row":138,"column":28},"end":{"row":138,"column":29},"action":"insert","lines":["i"],"id":2817}],[{"start":{"row":138,"column":29},"end":{"row":138,"column":30},"action":"insert","lines":["f"],"id":2818}],[{"start":{"row":64,"column":20},"end":{"row":78,"column":25},"action":"remove","lines":["<li>","                        <a class=\"page-scroll\" href=\"#buscar\">Buscar</a>","                    </li>","                    <li>","                        <a class=\"page-scroll\" href=\"#paquetes\">Paquetes</a>","                    </li>","                    <li>","                        <a class=\"page-scroll\" href=\"#miestado\">Mi Estado</a>","                    </li>","                    <li>","                        <a class=\"page-scroll\" href=\"#libres\">Libres</a>","                    </li>","                    <li>","                        <a class=\"page-scroll\" href=\"#empaquetar\">Empaquetar</a>","                    </li>"],"id":2819}],[{"start":{"row":109,"column":57},"end":{"row":109,"column":63},"action":"remove","lines":["nombre"],"id":2820},{"start":{"row":109,"column":57},"end":{"row":109,"column":58},"action":"insert","lines":["n"]}],[{"start":{"row":109,"column":58},"end":{"row":109,"column":59},"action":"insert","lines":["a"],"id":2821}],[{"start":{"row":109,"column":59},"end":{"row":109,"column":60},"action":"insert","lines":["m"],"id":2822}],[{"start":{"row":109,"column":60},"end":{"row":109,"column":61},"action":"insert","lines":["e"],"id":2823}],[{"start":{"row":210,"column":39},"end":{"row":211,"column":58},"action":"remove","lines":["","    <script src=\"js/finanzas/finanzas.charts.js\"></script>"],"id":2824}],[{"start":{"row":131,"column":43},"end":{"row":131,"column":53},"action":"remove","lines":["subheading"],"id":2825},{"start":{"row":131,"column":43},"end":{"row":131,"column":44},"action":"insert","lines":["h"]}],[{"start":{"row":131,"column":44},"end":{"row":131,"column":45},"action":"insert","lines":["e"],"id":2826}],[{"start":{"row":131,"column":45},"end":{"row":131,"column":46},"action":"insert","lines":["a"],"id":2827}],[{"start":{"row":131,"column":46},"end":{"row":131,"column":47},"action":"insert","lines":["d"],"id":2828}],[{"start":{"row":131,"column":47},"end":{"row":131,"column":48},"action":"insert","lines":["i"],"id":2829}],[{"start":{"row":131,"column":43},"end":{"row":131,"column":48},"action":"remove","lines":["headi"],"id":2830},{"start":{"row":131,"column":43},"end":{"row":131,"column":50},"action":"insert","lines":["heading"]}],[{"start":{"row":131,"column":76},"end":{"row":131,"column":81},"action":"remove","lines":["white"],"id":2831},{"start":{"row":131,"column":76},"end":{"row":131,"column":77},"action":"insert","lines":["b"]}],[{"start":{"row":131,"column":77},"end":{"row":131,"column":78},"action":"insert","lines":["l"],"id":2832}],[{"start":{"row":131,"column":78},"end":{"row":131,"column":79},"action":"insert","lines":["a"],"id":2833}],[{"start":{"row":131,"column":79},"end":{"row":131,"column":80},"action":"insert","lines":["k"],"id":2834}],[{"start":{"row":131,"column":79},"end":{"row":131,"column":80},"action":"remove","lines":["k"],"id":2835}],[{"start":{"row":131,"column":79},"end":{"row":131,"column":80},"action":"insert","lines":["c"],"id":2836}],[{"start":{"row":131,"column":80},"end":{"row":131,"column":81},"action":"insert","lines":["k"],"id":2837}],[{"start":{"row":132,"column":94},"end":{"row":132,"column":97},"action":"remove","lines":["FFF"],"id":2838}],[{"start":{"row":132,"column":93},"end":{"row":132,"column":94},"action":"remove","lines":["#"],"id":2839}],[{"start":{"row":132,"column":93},"end":{"row":132,"column":94},"action":"insert","lines":["b"],"id":2840}],[{"start":{"row":132,"column":94},"end":{"row":132,"column":95},"action":"insert","lines":["a"],"id":2841}],[{"start":{"row":132,"column":95},"end":{"row":132,"column":96},"action":"insert","lines":["l"],"id":2842}],[{"start":{"row":132,"column":96},"end":{"row":132,"column":97},"action":"insert","lines":["c"],"id":2843}],[{"start":{"row":132,"column":96},"end":{"row":132,"column":97},"action":"remove","lines":["c"],"id":2844}],[{"start":{"row":132,"column":95},"end":{"row":132,"column":96},"action":"remove","lines":["l"],"id":2845}],[{"start":{"row":132,"column":94},"end":{"row":132,"column":95},"action":"remove","lines":["a"],"id":2846}],[{"start":{"row":132,"column":94},"end":{"row":132,"column":95},"action":"insert","lines":["l"],"id":2847}],[{"start":{"row":132,"column":95},"end":{"row":132,"column":96},"action":"insert","lines":["a"],"id":2848}],[{"start":{"row":132,"column":96},"end":{"row":132,"column":97},"action":"insert","lines":["c"],"id":2849}],[{"start":{"row":132,"column":97},"end":{"row":132,"column":98},"action":"insert","lines":["k"],"id":2850}],[{"start":{"row":132,"column":184},"end":{"row":132,"column":188},"action":"remove","lines":["#FFF"],"id":2851},{"start":{"row":132,"column":184},"end":{"row":132,"column":185},"action":"insert","lines":["b"]}],[{"start":{"row":132,"column":185},"end":{"row":132,"column":186},"action":"insert","lines":["l"],"id":2852}],[{"start":{"row":132,"column":186},"end":{"row":132,"column":187},"action":"insert","lines":["a"],"id":2853}],[{"start":{"row":132,"column":187},"end":{"row":132,"column":188},"action":"insert","lines":["c"],"id":2854}],[{"start":{"row":132,"column":188},"end":{"row":132,"column":189},"action":"insert","lines":["k"],"id":2855}],[{"start":{"row":131,"column":116},"end":{"row":132,"column":0},"action":"insert","lines":["",""],"id":2856},{"start":{"row":132,"column":0},"end":{"row":132,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":132,"column":24},"end":{"row":132,"column":25},"action":"insert","lines":["<"],"id":2857}],[{"start":{"row":132,"column":25},"end":{"row":132,"column":26},"action":"insert","lines":["h"],"id":2858}],[{"start":{"row":132,"column":26},"end":{"row":132,"column":27},"action":"insert","lines":["r"],"id":2859}],[{"start":{"row":132,"column":27},"end":{"row":132,"column":28},"action":"insert","lines":[">"],"id":2860}]]},"ace":{"folds":[],"scrolltop":2922,"scrollleft":0,"selection":{"start":{"row":131,"column":28},"end":{"row":131,"column":28},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":true,"wrapToView":true},"firstLineState":{"row":59,"state":"start","mode":"ace/mode/php"}},"timestamp":1450217146700,"hash":"3c626ffca631c4a1046d367577833c0d3a44c259"}