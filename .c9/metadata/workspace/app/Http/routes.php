{"filter":false,"title":"routes.php","tooltip":"/app/Http/routes.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":17,"column":1},"end":{"row":17,"column":2},"action":"insert","lines":["/"],"id":111}],[{"start":{"row":17,"column":2},"end":{"row":17,"column":3},"action":"insert","lines":[" "],"id":112}],[{"start":{"row":17,"column":3},"end":{"row":17,"column":4},"action":"insert","lines":["C"],"id":113}],[{"start":{"row":17,"column":3},"end":{"row":17,"column":4},"action":"remove","lines":["C"],"id":114}],[{"start":{"row":17,"column":3},"end":{"row":17,"column":4},"action":"insert","lines":["S"],"id":115}],[{"start":{"row":17,"column":4},"end":{"row":17,"column":5},"action":"insert","lines":["i"],"id":116}],[{"start":{"row":17,"column":5},"end":{"row":17,"column":6},"action":"insert","lines":["m"],"id":117}],[{"start":{"row":17,"column":6},"end":{"row":17,"column":7},"action":"insert","lines":["c"],"id":118}],[{"start":{"row":17,"column":7},"end":{"row":17,"column":8},"action":"insert","lines":["a"],"id":119}],[{"start":{"row":17,"column":8},"end":{"row":17,"column":9},"action":"insert","lines":["r"],"id":120}],[{"start":{"row":17,"column":9},"end":{"row":17,"column":10},"action":"insert","lines":["d"],"id":121}],[{"start":{"row":17,"column":10},"end":{"row":17,"column":11},"action":"insert","lines":["s"],"id":122}],[{"start":{"row":17,"column":10},"end":{"row":17,"column":11},"action":"remove","lines":["s"],"id":123}],[{"start":{"row":17,"column":9},"end":{"row":17,"column":10},"action":"remove","lines":["d"],"id":124}],[{"start":{"row":17,"column":8},"end":{"row":17,"column":9},"action":"remove","lines":["r"],"id":125}],[{"start":{"row":17,"column":7},"end":{"row":17,"column":8},"action":"remove","lines":["a"],"id":126}],[{"start":{"row":17,"column":6},"end":{"row":17,"column":7},"action":"remove","lines":["c"],"id":127}],[{"start":{"row":17,"column":5},"end":{"row":17,"column":6},"action":"remove","lines":["m"],"id":128}],[{"start":{"row":17,"column":4},"end":{"row":17,"column":5},"action":"remove","lines":["i"],"id":129}],[{"start":{"row":17,"column":3},"end":{"row":17,"column":4},"action":"remove","lines":["S"],"id":130}],[{"start":{"row":17,"column":3},"end":{"row":17,"column":4},"action":"insert","lines":["B"],"id":131}],[{"start":{"row":17,"column":4},"end":{"row":17,"column":5},"action":"insert","lines":["U"],"id":132}],[{"start":{"row":17,"column":5},"end":{"row":17,"column":6},"action":"insert","lines":["S"],"id":133}],[{"start":{"row":17,"column":6},"end":{"row":17,"column":7},"action":"insert","lines":["C"],"id":134}],[{"start":{"row":17,"column":7},"end":{"row":17,"column":8},"action":"insert","lines":["A"],"id":135}],[{"start":{"row":17,"column":8},"end":{"row":17,"column":9},"action":"insert","lines":[" "],"id":136}],[{"start":{"row":17,"column":8},"end":{"row":17,"column":9},"action":"remove","lines":[" "],"id":137}],[{"start":{"row":17,"column":8},"end":{"row":17,"column":9},"action":"insert","lines":["R"],"id":138}],[{"start":{"row":17,"column":9},"end":{"row":17,"column":10},"action":"insert","lines":[" "],"id":139}],[{"start":{"row":17,"column":10},"end":{"row":17,"column":11},"action":"insert","lines":["S"],"id":140}],[{"start":{"row":17,"column":11},"end":{"row":17,"column":12},"action":"insert","lines":["I"],"id":141}],[{"start":{"row":17,"column":12},"end":{"row":17,"column":13},"action":"insert","lines":["M"],"id":142}],[{"start":{"row":17,"column":13},"end":{"row":17,"column":14},"action":"insert","lines":["C"],"id":143}],[{"start":{"row":17,"column":14},"end":{"row":17,"column":15},"action":"insert","lines":["A"],"id":144}],[{"start":{"row":17,"column":15},"end":{"row":17,"column":16},"action":"insert","lines":["R"],"id":145}],[{"start":{"row":17,"column":16},"end":{"row":17,"column":17},"action":"insert","lines":["D"],"id":146}],[{"start":{"row":20,"column":10},"end":{"row":20,"column":11},"action":"remove","lines":["i"],"id":147}],[{"start":{"row":20,"column":10},"end":{"row":20,"column":11},"action":"insert","lines":["I"],"id":148}],[{"start":{"row":20,"column":18},"end":{"row":20,"column":19},"action":"insert","lines":[" "],"id":149}],[{"start":{"row":20,"column":19},"end":{"row":20,"column":20},"action":"insert","lines":["S"],"id":150}],[{"start":{"row":20,"column":20},"end":{"row":20,"column":21},"action":"insert","lines":["I"],"id":151}],[{"start":{"row":20,"column":21},"end":{"row":20,"column":22},"action":"insert","lines":["M"],"id":152}],[{"start":{"row":20,"column":22},"end":{"row":20,"column":23},"action":"insert","lines":["C"],"id":153}],[{"start":{"row":20,"column":23},"end":{"row":20,"column":24},"action":"insert","lines":["A"],"id":154}],[{"start":{"row":20,"column":24},"end":{"row":20,"column":25},"action":"insert","lines":["R"],"id":155}],[{"start":{"row":20,"column":25},"end":{"row":20,"column":26},"action":"insert","lines":["D"],"id":156}],[{"start":{"row":20,"column":26},"end":{"row":20,"column":27},"action":"insert","lines":["S"],"id":157}],[{"start":{"row":13,"column":0},"end":{"row":15,"column":3},"action":"remove","lines":["Route::get('/', function () {","    return view('home');","});"],"id":158},{"start":{"row":13,"column":0},"end":{"row":14,"column":107},"action":"insert","lines":["","Route::get('simcard', array('middleware' => 'auth','as' => 'simcard', 'uses'=> 'FrontController@simcard'));"]}],[{"start":{"row":14,"column":12},"end":{"row":14,"column":19},"action":"remove","lines":["simcard"],"id":159},{"start":{"row":14,"column":12},"end":{"row":14,"column":13},"action":"insert","lines":["/"]}],[{"start":{"row":14,"column":12},"end":{"row":14,"column":13},"action":"remove","lines":["/"],"id":160}],[{"start":{"row":14,"column":100},"end":{"row":15,"column":0},"action":"insert","lines":["",""],"id":161}],[{"start":{"row":15,"column":0},"end":{"row":15,"column":100},"action":"insert","lines":["Route::get('', array('middleware' => 'auth','as' => 'simcard', 'uses'=> 'FrontController@simcard'));"],"id":162}],[{"start":{"row":15,"column":12},"end":{"row":15,"column":13},"action":"insert","lines":["h"],"id":163}],[{"start":{"row":15,"column":13},"end":{"row":15,"column":14},"action":"insert","lines":["o"],"id":164}],[{"start":{"row":15,"column":14},"end":{"row":15,"column":15},"action":"insert","lines":["m"],"id":165}],[{"start":{"row":15,"column":15},"end":{"row":15,"column":16},"action":"insert","lines":["e"],"id":166}],[{"start":{"row":15,"column":12},"end":{"row":15,"column":13},"action":"insert","lines":["/"],"id":167}],[{"start":{"row":21,"column":106},"end":{"row":22,"column":0},"action":"insert","lines":["",""],"id":168}],[{"start":{"row":22,"column":0},"end":{"row":23,"column":0},"action":"insert","lines":["",""],"id":169}],[{"start":{"row":23,"column":0},"end":{"row":28,"column":59},"action":"insert","lines":["// Login routes","Route::get('/home', 'HomeController@index');","Route::get('', 'HomeController@index');","Route::get('auth/login', 'Auth\\AuthController@getLogin');","Route::post('auth/login', 'Auth\\AuthController@postLogin');","Route::get('auth/logout', 'Auth\\AuthController@getLogout');"],"id":170}],[{"start":{"row":25,"column":0},"end":{"row":25,"column":1},"action":"insert","lines":["/"],"id":171}],[{"start":{"row":25,"column":1},"end":{"row":25,"column":2},"action":"insert","lines":["/"],"id":172}],[{"start":{"row":24,"column":0},"end":{"row":24,"column":1},"action":"insert","lines":["/"],"id":173}],[{"start":{"row":24,"column":1},"end":{"row":24,"column":2},"action":"insert","lines":["/"],"id":174}],[{"start":{"row":15,"column":13},"end":{"row":15,"column":17},"action":"remove","lines":["home"],"id":175},{"start":{"row":15,"column":13},"end":{"row":15,"column":14},"action":"insert","lines":["s"]}],[{"start":{"row":15,"column":14},"end":{"row":15,"column":15},"action":"insert","lines":["i"],"id":176}],[{"start":{"row":15,"column":15},"end":{"row":15,"column":16},"action":"insert","lines":["m"],"id":177}],[{"start":{"row":15,"column":16},"end":{"row":15,"column":17},"action":"insert","lines":["c"],"id":178}],[{"start":{"row":15,"column":17},"end":{"row":15,"column":18},"action":"insert","lines":["a"],"id":179}],[{"start":{"row":15,"column":18},"end":{"row":15,"column":19},"action":"insert","lines":["r"],"id":180}],[{"start":{"row":15,"column":19},"end":{"row":15,"column":20},"action":"insert","lines":["d"],"id":181}],[{"start":{"row":26,"column":12},"end":{"row":26,"column":13},"action":"insert","lines":["/"],"id":182}],[{"start":{"row":27,"column":13},"end":{"row":27,"column":14},"action":"insert","lines":["/"],"id":183}],[{"start":{"row":28,"column":12},"end":{"row":28,"column":13},"action":"insert","lines":["/"],"id":184}],[{"start":{"row":14,"column":100},"end":{"row":15,"column":0},"action":"insert","lines":["",""],"id":185}],[{"start":{"row":15,"column":0},"end":{"row":15,"column":100},"action":"insert","lines":["Route::get('', array('middleware' => 'auth','as' => 'simcard', 'uses'=> 'FrontController@simcard'));"],"id":186}],[{"start":{"row":15,"column":12},"end":{"row":15,"column":13},"action":"insert","lines":["\\"],"id":187}],[{"start":{"row":15,"column":12},"end":{"row":15,"column":13},"action":"remove","lines":["\\"],"id":188}],[{"start":{"row":15,"column":12},"end":{"row":15,"column":13},"action":"insert","lines":["/"],"id":189}],[{"start":{"row":15,"column":13},"end":{"row":15,"column":14},"action":"insert","lines":["h"],"id":190}],[{"start":{"row":15,"column":14},"end":{"row":15,"column":15},"action":"insert","lines":["m"],"id":191}],[{"start":{"row":15,"column":14},"end":{"row":15,"column":15},"action":"remove","lines":["m"],"id":192}],[{"start":{"row":15,"column":14},"end":{"row":15,"column":15},"action":"insert","lines":["o"],"id":193}],[{"start":{"row":15,"column":15},"end":{"row":15,"column":16},"action":"insert","lines":["m"],"id":194}],[{"start":{"row":15,"column":16},"end":{"row":15,"column":17},"action":"insert","lines":["e"],"id":195}],[{"start":{"row":14,"column":73},"end":{"row":14,"column":88},"action":"remove","lines":["FrontController"],"id":196},{"start":{"row":14,"column":73},"end":{"row":14,"column":88},"action":"insert","lines":["FrontController"]}],[{"start":{"row":24,"column":15},"end":{"row":26,"column":41},"action":"remove","lines":["","//Route::get('/home', 'HomeController@index');","//Route::get('', 'HomeController@index');"],"id":197}],[{"start":{"row":25,"column":12},"end":{"row":25,"column":13},"action":"remove","lines":["/"],"id":198}],[{"start":{"row":26,"column":13},"end":{"row":26,"column":14},"action":"remove","lines":["/"],"id":199}],[{"start":{"row":27,"column":12},"end":{"row":27,"column":13},"action":"remove","lines":["/"],"id":200}],[{"start":{"row":19,"column":103},"end":{"row":20,"column":0},"action":"insert","lines":["",""],"id":220}],[{"start":{"row":20,"column":0},"end":{"row":20,"column":133},"action":"insert","lines":["Route::get('simcard/buscarPaquete', array('middleware' => 'auth','as' => 'buscarPaquete', 'uses'=> 'FrontController@buscarPaquete'));"],"id":221}],[{"start":{"row":20,"column":100},"end":{"row":20,"column":115},"action":"remove","lines":["FrontController"],"id":222},{"start":{"row":20,"column":100},"end":{"row":20,"column":117},"action":"insert","lines":["SimcardController"]}],[{"start":{"row":21,"column":0},"end":{"row":21,"column":159},"action":"insert","lines":["Route::get('subdistribuidor/buscarTodos', array('middleware' => 'auth','as' => 'buscarSubdistribuidores', 'uses'=> 'FrontController@buscarSubdistribuidores'));"],"id":223}],[{"start":{"row":21,"column":116},"end":{"row":21,"column":121},"action":"remove","lines":["Front"],"id":224},{"start":{"row":21,"column":116},"end":{"row":21,"column":117},"action":"insert","lines":["S"]}],[{"start":{"row":21,"column":117},"end":{"row":21,"column":118},"action":"insert","lines":["i"],"id":225}],[{"start":{"row":21,"column":118},"end":{"row":21,"column":119},"action":"insert","lines":["m"],"id":226}],[{"start":{"row":21,"column":119},"end":{"row":21,"column":120},"action":"insert","lines":["c"],"id":227}],[{"start":{"row":21,"column":120},"end":{"row":21,"column":121},"action":"insert","lines":["a"],"id":228}],[{"start":{"row":21,"column":121},"end":{"row":21,"column":122},"action":"insert","lines":["r"],"id":229}],[{"start":{"row":21,"column":122},"end":{"row":21,"column":123},"action":"insert","lines":["d"],"id":230}]]},"ace":{"folds":[],"scrolltop":120,"scrollleft":0,"selection":{"start":{"row":22,"column":27},"end":{"row":22,"column":27},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":46,"mode":"ace/mode/php"}},"timestamp":1449799099390,"hash":"b3b00481f127b658da2404e86f771f20e4b84e5a"}