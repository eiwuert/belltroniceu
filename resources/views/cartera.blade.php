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
    <link href="css/cartera.css" rel="stylesheet">
    
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
                <div class="intro-heading">Administra tus deudas</div>
                <a href="/" class="page-scroll btn btn-xl">Volver</a>
            </div>
        </div>
    </header>
    @if($user->isAdmin)
    <section id="empaquetar">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Estado de cuenta</h2>
                    <h3 class="section-subheading text-muted" style="margin-bottom:40px">Revisa cada uno de los movimientos financieros del distribuidor escogido.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class ="flex_container">
                        <div style="min-width:220px;width:300;max-width:300px;margin-right:20px">
                            <select class="selectpicker" data-width="100%" data-style="data" id ="subPicker_distri" >
                                @foreach ($distribuidores as $distribuidor)
                                    <option>{{$distribuidor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="button" onClick="ver_cartera()" style="height:42px;width:10%;margin-right:20px">Ver</button>
                    </div>
                </div>
            </div>
            <div class="registro">
                <div class="container_fecha" stlye="margin-bottom:0"><label class="center_vert">FECHA</label></div>
                <div class="container_descripcion" stlye="margin-bottom:0"><label class="center_vert">DESCRIPCIÓN</label></div>
                <div class="container_cantidad" stlye="margin-bottom:0"><label class="center_vert">CANT.</label></div>
                <div class="container_valor" stlye="margin-bottom:0"><label class="center_vert">V. UNITARIO</label></div>
                <div class="container_total" stlye="margin-bottom:0"><label class="center_vert">TOTAL</label></div>
                <div class="container_total" style="max-width:500px;width:50px"></div>
                <div class="container_total" style="max-width:500px;width:50px"></div>
            </div>
            <div id ="registros_container">
                
            </div>
        </div>
    </section>
    @else
    <section id="empaquetar">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Estado de cuenta</h2>
                    <h3 class="section-subheading text-muted" style="margin-bottom:40px">Revisa cada uno de tus movimientos financieros.</h3>
                </div>
            </div>
            <div class="registro">
                <div class="container_fecha" stlye="margin-bottom:0"><label class="center_vert">FECHA</label></div>
                <div class="container_descripcion" stlye="margin-bottom:0"><label class="center_vert">DESCRIPCIÓN</label></div>
                <div class="container_cantidad" stlye="margin-bottom:0"><label class="center_vert">CANT.</label></div>
                <div class="container_valor" stlye="margin-bottom:0"><label class="center_vert">V. UNITARIO</label></div>
                <div class="container_total" stlye="margin-bottom:0"><label class="center_vert">TOTAL</label></div>
            </div>
            @foreach($retorno as $registro)
            <div class="registro">
                @if($registro['total'] < 0)
                <div class="container_fecha red_soft"><label class="center_vert">{{$registro['fecha']}}</label></div>
                <div class="container_descripcion red_soft"><label class="center_vert">{{$registro['descripcion']}}</label></div>
                <div class="container_cantidad red_soft"><label class="center_vert">{{$registro['cantidad']}}</label></div>
                <div class="container_valor red_soft"><label class="center_vert">${{number_format($registro['valor_unitario']*-1,0,".",",")}}</label></div>
                <div class="container_total red_soft"><label class="center_vert">${{number_format($registro['total']*-1,0,".",",")}}</label></div>
                @else
                <div class="container_fecha green_soft"><label class="center_vert">{{$registro['fecha']}}</label></div>
                <div class="container_descripcion green_soft"><label class="center_vert">{{$registro['descripcion']}}</label></div>
                <div class="container_cantidad green_soft"><label class="center_vert">{{$registro['cantidad']}}</label></div>
                <div class="container_valor green_soft"><label class="center_vert">${{number_format($registro['valor_unitario'],0,".",",")}}</label></div>
                <div class="container_total green_soft"><label class="center_vert">${{number_format($registro['total'],0,".",",")}}</label></div>
                @endif
            </div>
            @endforeach
            <hr>
            <div class="registro" id ="total">
                @if($total < 0)
                <div class="container_descripcion red_soft"><label class="center_vert">TOTAL</label></div>
                <div class="container_total red_soft"><label class="center_vert">${{number_format($total*-1,0,".",",")}}</label></div>
                @else
                <div class="container_descripcion green_soft"><label class="center_vert">TOTAL</label></div>
                <div class="container_total green_soft"><label class ="center_vert">${{number_format($total,0,".",",")}}</label></div>
                @endif
            </div>
            <div class="registro" id ="total_comisiones">
                <div class="container_descripcion blue"><label class="center_vert">TOTAL COMISIONES</label></div>
                <div class="container_total blue"><label class="center_vert">${{number_format($comisiones,0,".",",")}}</label></div>
            </div>
            @if($total < 0)
            <label>A trabajar fuertemente para pagar esa deuda.</label>
            @else
            <label>Vas muy bien... Sigue asi.</label>
            @endif
        </div>
    </section>
    @endif
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
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Charts Script -->
    <script src="js/Chart.js"></script>
    
    <!-- Page Script  -->
    <script src="js/cartera/cartera.js"></script>
    
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
