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
    <link href="css/control/control.css" rel="stylesheet">
    
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
    
    <!-- GOOGLE LOCATION API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>

<body id="page-top" class="index" style="background-image:url('/img/texture/simcard.png');">
    
    @if($user->isAdmin)
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
                <div class="intro-heading">Vigila tus empleados</div>
                <a href="/" class="page-scroll btn btn-xl">Volver</a>
            </div>
        </div>
    </header>
    
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Revisa la ubicación de tus empleados</h2>
                    <h3 class="section-subheading text-muted" style="color:black;margin-bottom:10px">Escoge un empleado, presiona el boton BUSCAR y finalmente dale click a una fecha para ver el mapa.</h3>
                </div>
            </div>
            <div class="row text-center">
                <select class="selectpicker" data-width="50%" data-style="data" id ="subPicker_cedula">
                    @foreach ($cedulas as $cedula)
                        <option>{{$cedula->cedula}}</option>
                    @endforeach
                </select>
                <button class ="button" style="margin-left:20px" onClick = "buscar()">Buscar</button>
            </div>
            <div id ="resultado_coordenadas" style="margin-top:50px">
                
            </div>
        </div>
    </section>
    
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
    @endif
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Plugin JavaScript -->
    <script src="/js/jquery.easing.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <!-- Bootstrap Select JS -->
    <script src ="/js/utilities/bootstrap-select.js" ></script>
    
    <!-- CUSTOM JS -->
    <script src="js/control/vendedores.js"></script>
    
    <!-- classie -->
    <script src="/js/classie.js"></script>}
    
    <!-- agency -->
    <script src="/js/agency.js"></script>}
    
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