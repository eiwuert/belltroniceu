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

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Page CSS  -->
    <link href="css/simcard.css" rel="stylesheet">
    
    <!-- Colors CSS -->
    <link href="css/colors.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand page-scroll" href="#page-top">Belltronic</a>
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
                        <a class="page-scroll" href="#">Finanzas</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">Cartera</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Bienvenido a tu portal</div>
                <div class="intro-heading">Revisa tus simcards</div>
                <a href="#services" class="page-scroll btn btn-xl">Volver</a>
            </div>
        </div>
    </header>

    <!-- BUSCAR SIMCARD   -->
    <section id="buscar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Encuentra tus Simcards</h2>
                    <h3 class="section-subheading text-muted">Ingresa la ICC o el numero de telefono. 
                    Recuerda que <span class ="red_text"> Rojo </span> es Vencida, <span class ="blue_text">Azul</span> es Disponible y <span class ="green_text">verde</span> es Activada.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4" style="display: inline-block;
    vertical-align: middle;
    float: none;">
                    <div id="search_container" class = "search_container">
                        <h3 class = "section_body_content white" style="margin-top:0">Busca una simcard</h3>
                            <input class = "data" type="number" placeholder = "ICC / Tel" id = "dato_buscar_sim" />
                        <div style="margin:auto">
                            <button class="button button_delete" style="margin-right:4%;width:45%" onClick="limpiar_campos()">Limpiar</button>
                            <button class = "button" style="width:45%" onClick = "buscarSim()">Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7" style="display: inline-block;
    vertical-align: middle;
    float: none;">
                    <div class = "search_results_container" >
                        <div class ="gray" style="flex-grow:2" id="ICC-container">
                            <input class="center white white_input" type="number" id = "ICC-resultado" placeholder="ICC"></input>
                        </div>
                        <div class ="gray" style="flex-grow:2" id="telefono-container">
                            <input class="center white white_input" type="number" id = "telefono-resultado" placeholder="Teléfono"></input>
                        </div>
                        <div class ="gray" style="flex-grow:2" id="paquete-container">
                            <input class="center white white_input" type="number" id = "paquete-resultado" placeholder="Paquete"></input>
                        </div>
                        <div class ="gray" style="flex-grow:2" id="tipo-container">
                            <input class="center white white_input" type="text" id = "tipo-resultado" placeholder="Tipo"></input>
                        </div>
                        <div class ="gray" style="flex-grow:2" id="distribuidor-container">
                            <button class="center white white_input" id ="distribuidor-resultado" onClick="$('#modal-distribuidor').modal('show')" style="background:none;border:none;" >Distribuidor</button>
                        </div>
                        <div class ="gray" style="flex-grow:2" id="subdistribuidor-container">
                            <button class="center white white_input" id ="subdistribuidor-resultado" onClick="$('#modal-subdistribuidor').modal('show')" style="background:none;border:none;">Subdistribuidor</button>
                        </div>
                        <div class ="gray" style="flex-grow:2" id="fecha_vencimiento-container">
                            <input class="center white white_input" type="date" id = "fecha_vencimiento-resultado" placeholder="Vencimiento"></input>
                        </div>
                        <div class ="gray" style="flex-grow:2" id="fecha_activacion-container">
                            <input class="center white white_input" type="date" id = "fecha_activacion-resultado" placeholder="Activación"></input>
                        </div style="align-self:flex-end">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCION PAQUETES -->
    <section id="paquetes" class="bg-light-gray">
        <div class="container">
             <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Encuentra tus paquetes</h2>
                    <h3 class="section-subheading text-muted">Ingresa el numero de paquete que quieres buscar. Puedes darle click a una simcard para obtener más información de ella.</h3>
                </div>
            </div>
            <div class="principal-view-body-container">
                <div class ="package_form_container">
                    <input class="data_package" type="number" id = "paquete-busqueda" placeholder="Paquete" style="width:40%"></input>
                    <button class="button" onClick="buscarPaquete()" style="height:42px;width:10%">Buscar</button>
                </div>
                <div class = "search_results_container" id ="container_simcards_paquete">
                      
                </div>
            </div>
        </div>
    </section>
    
    <!-- SECCION MI ESTADO -->
    <section id="miestado">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Estado Simcards</h2>
                    <h3 class="section-subheading text-muted">Revisa el estado de tus simcards separadas por tipo y mes.</h3>
                </div>
            </div>
            <div class="row">
                <div class ="mystatus_container">
                    <div>
                        <div class="chart_container">
                            <div style="weight:100%;height:100%">
                                <canvas id="canvasPrepago"></canvas>
                            </div>
                        </div>
                        <div class="portfolio-caption">
                            <h4 style ="text-align:center;">Prepago Pack</h4>
                        </div>
                    </div>
                    <div>
                        <div class="chart_container">
                            <div style="weight:100%;height:100%">
                                <canvas id="canvasLibre"></canvas>
                            </div>
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
    
    <div id="modal-distribuidor" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class = "section-body section-body-title"> Seleccionar Distribuidor</h3>
                </div>
                <div class="modal-body">
                    <div class=".container" id ="modal-body-distribuidores">
                    @foreach($distribuidores as $distribuidor)
                        <button class="button-simcards button-default" style="flex-grow:2; margin-top:10px" onClick="seleccionar_distribuidor(this)" value ="{{$distribuidor->name}}">{{$distribuidor->name}}</button>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-subdistribuidor" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class = "section-body section-body-title"> Seleccionar subdistribuidor</h3>
                </div>
                <div class="modal-body">
                    <div class=".container" id ="modal-body-subdistribuidores">
                    @foreach($subdistribuidores[$user->name] as $subdistribuidor)
                        <button class="button-simcards button-default" style="flex-grow:2; margin-top:10px" onClick="seleccionar_sub(this)" value ="{{$subdistribuidor->nombre}}">{{$subdistribuidor->nombre}}</button>
                    @endforeach
                    </div>
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
    <script src="js/simcard.charts.js"></script>
    
    <!-- Page Script  -->
    <script src="js/simcard.js"></script>
    
    <!-- Plugin JavaScript -->
    <script src="/js/jquery.easing.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

</body>

</html>
