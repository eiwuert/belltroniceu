<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Belltronic</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Selectpicker CSS -->
    <link href="css/utilities/bootstrap-select.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Page CSS  -->
    <link href="css/recargas/recargas.css" rel="stylesheet">
    
    <!-- Colors CSS -->
    <link href="css/colors.css" rel="stylesheet">
    
    <!-- Base CSS -->
    <link href="css/base.css" rel="stylesheet">
    
    <!-- Loading Animation CSS -->
    <link href="css/utilities/utilities.css" rel="stylesheet">

    
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
</head>

<body id="page-top" class="index">
    
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="/">Belltronic</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#estado_recargas">Recargas</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#estado_simcards">Simcards</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#proyecciones">Proyecciones</a>
                    </li>
                    @if($user->isAdmin)
                    <li>
                        <a class="page-scroll" href="#" onClick="borrar_recargas()">Borrar</a>
                    </li>
                    <li>
                        <a class="page-scroll" data-target="#modal_upload" data-toggle="modal" href="#modal_upload"><span class="glyphicon glyphicon-cloud-upload"></span></a>
                    </li>
                    @endif
                    <li>
                        <a class="page-scroll" href="/settings"><span class="glyphicon glyphicon-cog"></span></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/auth/logout"><span class="glyphicon glyphicon-off"></span></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container dark_cover">
            <div class="intro-text">
                <div class="intro-lead-in">Bienvenido a tu portal</div>
                <div class="intro-heading">Revisa tus recargas</div>
                <a href="/" class="page-scroll btn btn-xl">Volver</a>
            </div>
        </div>
    </header>

    <!-- SECCION MI HISTORIAL -->
    <section id="estado_recargas">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Estado Recargas</h2>
                    <h3 class="section-subheading text-muted" style="color:black;margin-bottom:20px">Observa las recargas separadas en tus subdistribuidores, el total recargado por cada tipo de simcard y la distribución de cada una.</h3>
                </div>
            </div>
            <div class="row text-center ">
                <div style="display: inline-block;vertical-align: middle;float: none;width:100%">
                    <div class="flex_container" style="width:100%">
                        @if($user->isAdmin)
                        <select class="selectpicker" data-width="100%" data-style="data" id ="subPicker_distri" style="min-width:220px">
                            @foreach ($distribuidores as $distribuidor)
                                <option>{{$distribuidor->name}}</option>
                            @endforeach
                        </select>
                        @endif
                        <select class="selectpicker" style="padding:0;margin:0" data-width="20%%" data-style="data" id ="subPicker_fecha">
                            @foreach ($fechas as $fecha)
                            <option>{{$fecha->fecha}}</option>
                            @endforeach
                        </select>
                        @if($user->isAdmin)
                        <button class="button button_assign" onClick="consultar_recargas()" style=";width:100px;padding:0;">Consultar</button>
                        <button class="button button_assign_inverse" onClick="descargar_recargas_admin()" style=";width:200px;padding:0;">BAJAR INFORME</button>
                        @else
                        <button class="button button_assign" onClick="consultar_recargas_no_admin()" style=";width:100px;padding:0;">Consultar</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row text-center" style="margin-top:20px">
                <div class="col-md-4" style="display: inline-block;vertical-align: middle;float: none;">
                    <div class = "valores_sub_container">
                        <h3 class="section-heading text-muted" style="color:black;margin-bottom:20px">Recargas</h3>
                        <hr>
                        <label class="heading_label">PREPAGO</label><label class="heading_label">LIBRE</label>
                        <div id = "valores_subs">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="display: inline-block;vertical-align: middle;float: none;">
                    <div style="display: inline-block;vertical-align: middle;float:none;margin: 0 20px">
                        <div style="width:250px;height:250px">
                            <canvas id="canvasHistorial"></canvas>
                        </div>
                        <div class="portfolio-caption">
                            <h4 style ="text-align:center;">Distribución recargas</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- SECCION SIMS 3000 -->
    <section id="estado_simcards" class="parallax" style="padding:0">
        <div id="estado_simcards_container" class="container dark_cover" style="padding:100px 20px;">
            @if($user->isAdmin)
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading" style="color:white;margin-bottom:50px">Estado Simcards</h2>
                    <h3 class="section-subheading text-muted" style="color:white;margin-bottom:20px">Observa las simcards con menos de 3000 en recargas que han sido activadas en la fecha escogida.</h3>
                </div>
            </div>
            <div class="row text-center ">
                <div style="display: inline-block;vertical-align: middle;float: none;width:100%">
                    <div class="flex_container" style="width:100%">
                        <select class="selectpicker" style="padding:0;margin:0" data-width="20%%" data-style="data" id ="subPicker_fecha_estado">
                            @foreach ($fechas as $fecha)
                            <option>{{$fecha->fecha}}</option>
                            @endforeach
                        </select>
                        <button class="button button_assign_inverse" onClick="consultar_simcards()" style=";width:200px;padding:0;">BAJAR INFORME</button>
                    </div>
                </div>
            </div>
            @endif
            
            @if($user->isAdmin)
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-subheading text-muted" style="color:white;margin-bottom:20px">Observa las simcards con sus respectivas recargas que han sido activadas en el periodo escogido filtradas por distribuidor.</h3>
                </div>
            </div>
            <div class="row text-center ">
                <div style="display: inline-block;vertical-align: middle;float: none;width:100%">
                    <div class="flex_container" style="width:100%">
                        <select class="selectpicker" data-width="100%" data-style="data" id ="subPicker_estado_distri" style="min-width:220px">
                            @foreach ($distribuidores as $distribuidor)
                                <option value ="{{$distribuidor->name}}">{{$distribuidor->name}}</option>
                            @endforeach
                        </select>
                        <select class="selectpicker" style="padding:0;margin:0" data-width="20%%" data-style="data" id ="subPicker_fecha_distri">
                            @foreach ($fechas as $fecha)
                            <option>{{$fecha->fecha}}</option>
                            @endforeach
                        </select>
                        <button class="button button_assign_inverse" onClick="consultar_simcards_distribuidor()" style=";width:200px;padding:0;">BAJAR INFORME</button>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-subheading text-muted" style="color:white;margin-bottom:20px">Observa las simcards con sus respectivas recargas que han sido activadas en el periodo escogido.</h3>
                </div>
            </div>
            <div class="row text-center ">
                <div style="display: inline-block;vertical-align: middle;float: none;width:100%">
                    <div class="flex_container" style="width:100%">
                        <select class="selectpicker" style="padding:0;margin:0" data-width="20%%" data-style="data" id ="subPicker_fecha_distri_noadmin">
                            @foreach ($fechas as $fecha)
                            <option>{{$fecha->fecha}}</option>
                            @endforeach
                        </select>
                        <button class="button button_assign_inverse" onClick="consultar_simcards_distribuidor_no_admin()" style=";width:200px;padding:0;">BAJAR INFORME</button>
                    </div>
                </div>
            </div>
            @endif
            <div class="row text-center ">
                <div style ="width:50%;margin: 30px auto" id ="msg_recargas_sim">
                    
                </div>
            </div>
        </div>
    </section>
    
     <section id="proyecciones" class="parallex">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Proyecciones</h2>
                    <h3 class="section-subheading text-muted" style="color:black;margin-bottom:20px">Observa las proyecciones de recargas y ganancias, al igual que otras cifras importantes calculadas con los datos actuales de la fecha escogida.</h3>
                </div>
            </div>
            <div class="row text-center ">
                <div style="display: inline-block;vertical-align: middle;float: none;width:100%">
                    <div class="flex_container" style="width:100%">
                        @if($user->isAdmin)
                        <select class="selectpicker" data-width="100%" data-style="data" id ="subPicker_distri_proyeccion" style="min-width:220px">
                            <option>TODOS</option>
                            @foreach ($distribuidores as $distribuidor)
                                <option>{{$distribuidor->name}}</option>
                            @endforeach
                        </select>
                        @endif
                        <select class="selectpicker" style="padding:0;margin:0" data-width="20%%" data-style="data" id ="subPicker_fecha_proyeccion">
                            @foreach ($fechas as $fecha)
                            <option>{{$fecha->fecha}}</option>
                            @endforeach
                        </select>
                        @if($user->isAdmin)
                        <button class="button button_assign" onClick="calcular_proyecciones()" style=";width:150px;padding:0;">Calcular</button>
                        @else
                        <button class="button button_assign" onClick="calcular_proyecciones_no_admin()" style=";width:150px;padding:0;">Calcular</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row text-center ">
                <div class="col-lg-12 text-center" id ="proyecciones_container">
                </div>
            </div>
        </div>
    </section>
    
    <iframe id="my_iframe" style="display:none;"></iframe>
    <!--------------------------------------MODALS------------------------------------------------->
    <div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 id ="modal-tittle"></h3>
                </div>
                <div class="modal-body">
                    <p id ="modal-body"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL LOADING -->
    <div id="modal-loading" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-body">
            <a class="btn btn-danger loading" style = "width:100%;">Cargando información</a>
        </div>
    </div>
    <!-- MODAL UPLOAD RESULT -->
    @if(null !== Session::get('result'))
    <div id="modal_upload_result" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id ="modal-tittle">Resultado Operacion</h3>
                </div>
                <div class="modal-body">
                    <label id = "modal_upload_result_label">{{Session::get('result')}} filas añadidas </label>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- CARGAR ARCHIVO -->
    <div id="modal_upload" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 id ="modal-tittle">Subir Recargas</h3>
                </div>
                <div class="modal-body">
                    <p>Al presionar SUBIR se debe esperar que se recarge la página.</p>
                    {!! Form::open(
                    array(
                        'route' => 'agregarRecargas', 
                        'class' => 'form', 
                        'novalidate' => 'novalidate', 
                        'files' => true)) !!}
                    <input name="_token" hidden value="{!! csrf_token() !!}" />
                    <div class="form-group">
                        {!! Form::file('image', null) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::submit('Subir',['class' => 'button', 'onClick' => 'load()']) !!}
                    </div>
                    {!! Form::close() !!}        
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Charts Script -->
    <script src="js/Chart.js"></script>
    
    <!-- Page Script  -->
    <script src="js/recargas/recargas.js"></script>
    
    <!-- Plugin JavaScript -->
    <script src="/js/jquery.easing.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

    <!-- Bootstrap Select JS -->
    <script src ="/js/utilities/bootstrap-select.js" ></script>
    
    <div id="footerwrap">
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-12 col-lg-12">
      			<logo class="logo">Belltronic</logo>
      			<p>Desarrollado por <span class="mySpan">Stiven Avila</span> - stiven140@hotmail.com</p>
      			</div>

      		</div><!-- /row -->
      	</div><!-- /container -->		
	</div><!-- /footerwrap -->
</body>

</html>
