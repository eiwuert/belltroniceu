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
    <link href="css/finanzas.css" rel="stylesheet">
    
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
                        <a class="page-scroll" href="#buscar">Buscar</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#paquetes">Paquetes</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#miestado">Mi Estado</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#libres">Libres</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#empaquetar">Empaquetar</a>
                    </li>
                    @if($user->isAdmin)
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
                <div class="intro-heading">Revisa tus ganancias</div>
                <a href="/" class="page-scroll btn btn-xl">Volver</a>
            </div>
        </div>
    </header>


    <section id="miestado" class="parallex">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Ganancias subdistribuidores</h2>
                    <h3 class="section-subheading text-muted" style="color:black;margin-bottom:0">Selecciona un subdistribuidor y un periodo para ver las ganancias en el gráfico.</h3>
                    <h3 class="section-subheading text-muted" style="color:black;margin-bottom:20px">En primer lugar veras el total ganado y en segundo lugar el total despues de impuestos <strong>(1% retención a la comisión + 4.14% ICA).</strong></h3>
                </div>
            </div>
            <div class="row text-center ">
                <div class="col-md-4" style="display: inline-block;vertical-align: middle;float: none;">
                    <div id="search_container" class = "search_container">
                        <h3 class = "section_body_content white" style="margin-top:0">Elige un subdistribuidor</h3>
                        @if($user->isAdmin)
                        <select class="selectpicker" data-width="100%" data-style="data" id ="subPicker_subdistri">
                            @foreach ($distribuidores as $distribuidor)
                            <optgroup label="{{$distribuidor->name}}">
                                @foreach ($subdistribuidores[$distribuidor->name] as $subdistribuidor)
                                <option>{{$subdistribuidor->nombre}}</option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        @else
                        <select class="selectpicker" data-width="100%" data-style="data" id ="subPicker_subdistri">
                            @foreach ($subdistribuidores as $subdistribuidor)
                            <option>{{$subdistribuidor->nombre}}</option>
                            @endforeach
                        </select>
                        @endif
                        <select class="selectpicker" data-width="100%" data-style="data" id ="subPicker_periodo">
                            @foreach ($periodos as $periodo)
                            <option>{{$periodo->periodo}}</option>
                            @endforeach
                        </select>
                        <button class="button button_assign" onClick="consultar_subdistribuidor()" style="height:42px;width:100px;margin:0 auto">Consultar</button>
                    </div>
                </div>
                <div class="col-md-4" style="display: inline-block;vertical-align: middle;float: none;">
                    <div id="search_container" class = "search_container" style="padding: 5px 0">
                        <label style="color:white;width:45%;margin-top:5px">Prepago</label>
                        <label style="color:white;width:45%;margin-top:5px">Libre</label>
                        <input class = "data_estado" id = "total_dis_prepago" disabled=true placeholder ="Distribuidor" >
                        <input class = "data_estado" id = "total_dis_libre" disabled=true placeholder ="Distribuidor" >
                        <input class = "data_estado" id = "total_sub_prepago" disabled=true placeholder="Subdisitribuidor" style="color:white">
                        <input class = "data_estado" id = "total_sub_libre" disabled=true placeholder ="Subdistribuidor" style="margin-top:10px">
                        <hr>
                        <input class = "data_estado" id = "total_dis_prepago_at" disabled=true placeholder ="Distribuidor" >
                        <input class = "data_estado" id = "total_dis_libre_at" disabled=true placeholder ="Distribuidor" >
                        <input class = "data_estado" id = "total_sub_prepago_at" disabled=true placeholder="Subdisitribuidor" style="color:white">
                        <input class = "data_estado" id = "total_sub_libre_at" disabled=true placeholder ="Subdistribuidor" style="margin-top:10px">
                    </div>
                </div>
            </div>
            <div class="row text-center" style="margin-top:20px">
                <div class="col-md-4" style="display: inline-block;vertical-align: middle;float: none;">
                    <div style="display: inline-block;vertical-align: middle;float:none;margin: 0 20px">
                        <div style="width:250px;height:250px">
                            <canvas id="canvasPrepago"></canvas>
                        </div>
                        <div class="portfolio-caption">
                            <h4 style ="text-align:center;">Prepago Pack</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="display: inline-block;vertical-align: middle;float: none;">
                    <div style="display: inline-block;vertical-align: middle;float:none;margin: 0 20px">
                        <div style="width:250px;height:250px">
                            <canvas id="canvasLibre"></canvas>
                        </div>
                        <div class="portfolio-caption">
                            <h4 style ="text-align:center;">Libre</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    
    <!-- CARGAR ARCHIVO -->
    <div id="modal_upload" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 id ="modal-tittle">Subir Comisiones</h3>
                </div>
                <div class="modal-body">
                    <p>Al presionar SUBIR se debe esperar que se recarge la página.</p>
                    {!! Form::open(
                    array(
                        'route' => 'agregarComisiones', 
                        'class' => 'form', 
                        'novalidate' => 'novalidate', 
                        'files' => true)) !!}
                    <input name="_token" hidden value="{!! csrf_token() !!}" />
                    <div class="form-group">
                        {!! Form::file('image', null) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::submit('Subir') !!}
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
    <script src="js/finanzas.charts.js"></script>
    
    <!-- Page Script  -->
    <script src="js/finanzas/finanzas.js"></script>
    
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
